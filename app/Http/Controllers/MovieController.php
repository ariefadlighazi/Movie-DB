<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\OmdbService;

class MovieController extends Controller
{

    protected OmdbService $service;

    public function __construct(OmdbService $service) {
        $this->service = $service;
    }

    //
    public function index(Request $request) {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        
        if ($search) {
            $data = $this->service->searchMovies($search, $page);
        } else {
            $data = $this->service->fetchData();
        }

        $userFavorites = [];
        if (auth()->check()) {
            $userFavorites = auth()->user()->favorites()->pluck('imdbID')->toArray();
        }

        if ($request->ajax()) {
            return view('partials.MovieCard' , ['movies' => $data['Search'] ?? [], 'userFavorites' => $userFavorites])->render();
            Log::info('AJAX request processed');
        }

        return view('welcome', [
            'movies' => $data['Search'] ?? [],
            'totalResults' => $data['totalResults'] ?? 0,
            'query' => $search,
            'page' => $page,
            'userFavorites' => $userFavorites,
        ]);
    }

    public function detail($imdbId) {
        $data = $this->service->fetchDetail($imdbId);

        $isFavorite = false;
        if (auth()->check()) {
            $isFavorite = auth()->user()->favorites()->where('imdbID', $imdbId)->exists();
        }

        return view('MovieDetail', [
            'movie' => $data,
            'isFavorite' => $isFavorite,
        ]);
    }

    public function toggleFavorite(Request $request) {
        $user = auth()->user();
        $imdbID = $request->input('imdbID');

        $exist = $user->favorites()->where('imdbID', $imdbID)->first();


        if ($exist) {
            $exist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            $user->favorites()->create([
                'imdbID' => $request->input('imdbID'),
                'Title' => $request->input('Title'),
                'Year' => $request->input('Year'),
                'Poster' => $request->input('Poster'),
                'Type' => $request->input('Type'),
            ]);
            
            return response()->json(['status' => 'added']);
        }
    }

    public function listFavorites() {
        $favorites = auth()->user()->favorites()->orderBy('created_at', 'desc')->get();

        return view('Favorites', [
            'movies' => $favorites,
        ]);
    }
}
