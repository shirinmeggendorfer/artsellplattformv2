<?php

// backend/routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthenticatedSessionController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/picture', [ProfileController::class, 'updatePicture']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    Route::delete('/profile/item/{item}', [ProfileController::class, 'destroyItem']);

    Route::get('/items', [ArticleController::class, 'index']);
    Route::get('/items/{item}', [ArticleController::class, 'show']);
    Route::post('/items', [ArticleController::class, 'store']);

    Route::get('/homeitems', [HomeController::class, 'index']);
    Route::get('/search', [HomeController::class, 'startPage']);
});
