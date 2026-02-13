@extends('layouts.app')

@section('title', 'My Favorites')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white border-b pb-4">My Favorite Movies</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        @forelse ($movies as $m)
            
            @include('partials.MovieCard', ['movies' => [$m]]) 
            
        @empty
            <div class="text-center py-20 bg-gray-50 dark:bg-gray-800 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No favorites yet</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by searching for movies and clicking the heart icon.</p>
                <div class="mt-6">
                    <a href="{{ route('movie.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Search Movies
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection