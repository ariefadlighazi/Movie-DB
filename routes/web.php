<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('movie.index');
    Route::get('/movie/{id}', [MovieController::class, 'detail'])->name('movie.detail');

    Route::get('/favorites', [MovieController::class,'listFavorites'])->name('favorites.index');
    Route::post('/favorites/toggle', [MovieController::class,'toggleFavorite'])->name('favorite.toggle');
});
