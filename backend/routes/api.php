<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;


//Route::get('/sanctum/csrf-cookie', [SanctumCsrfCookieController::class, 'show']);


Route::middleware('api')->group(function () {
    Route::get('/sanctum/csrf-cookie', 'Laravel\Sanctum\Http\Controllers\CsrfCookieController@show')->name('sanctum.csrf-cookie');
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthenticatedSessionController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');


// Routen, die keine Authentifizierung benötigen
Route::get('/items', [ArticleController::class, 'index']);
Route::get('/search', [HomeController::class, 'startPage']);
Route::get('/items/{item}', [ArticleController::class, 'show']);
Route::get('/homeitems', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/picture', [ProfileController::class, 'updatePicture']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    Route::delete('/profile/item/{item}', [ProfileController::class, 'destroyItem']);
    Route::post('/items', [ArticleController::class, 'store']);
    Route::get('/user/items', [ArticleController::class, 'userItems']);
    Route::put('/items/{item}', [ArticleController::class, 'update']);
    Route::delete('/items/{item}', [ArticleController::class, 'destroy']);
    
});
