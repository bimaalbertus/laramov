<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PeopleController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('media', [MediaController::class, 'index']);
    Route::get('media/{mediaType}/{id}', [MediaController::class, "tv"]);
    Route::post('media/tmdb', [MediaController::class, 'store']);
    Route::post('media', [MediaController::class, 'insert']);
    Route::delete('media', [MediaController::class, 'deleteAll']);
    Route::delete('media/{id}', [MediaController::class, 'deleteById']);
    Route::put('media/{id}', [MediaController::class, 'update']);
    Route::post('media/search', [MediaController::class, 'search']);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('people', [PeopleController::class, 'index']);
    Route::post('people/search', [PeopleController::class, 'search']);
    Route::post('people/tmdb', [PeopleController::class, 'store']);
    Route::delete('people', [PeopleController::class, 'deleteAll']);
    Route::delete('people/{id}', [PeopleController::class, 'deleteById']);
});

Route::prefix('/')->name('pages.')->group(function () {
    Route::get("/", [MovieController::class, "index"]);
    Route::get('/{mediaType}/{id}', [MovieController::class, "detail"]);
    Route::get('/{mediaType}/{id}/watch', [MovieController::class, "watch"]);
});
