<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('media', [MediaController::class, 'index']);
    Route::post('media/tmdb', [MediaController::class, 'store']);
    Route::post('media', [MediaController::class, 'insert']);
    Route::delete('media', [MediaController::class, 'deleteAll']);
    Route::delete('media/{id}', [MediaController::class, 'deleteById']);
    Route::put('media/{id}', [MediaController::class, 'update']);
});

Route::prefix('/')->name('pages.')->group(function () {
    Route::get("/", [MovieController::class, "index"]);
    Route::get('/{mediaType}/{id}', [MovieController::class, "detail"]);
});
