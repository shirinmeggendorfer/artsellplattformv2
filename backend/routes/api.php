<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'getUsers']);
    Route::get('/admin/users/{user}', [AdminController::class, 'getUser']);
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser']);
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser']);
    Route::get('/admin/users/{user}/items', [AdminController::class, 'getUserItems']);
    Route::get('/admin/items/{item}', [AdminController::class, 'getArticle']);
    Route::put('/admin/items/{item}', [AdminController::class, 'updateArticle']);
    Route::delete('/admin/items/{item}', [AdminController::class, 'destroyArticle']);
    Route::get('/admin/search', [AdminController::class, 'searchUser']);

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

    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']); 
    Route::get('/messages/{id}', [MessageController::class, 'show']);
    Route::get('/conversations/{user}/{articleId}', [MessageController::class, 'conversation']);
});

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

// Password reset routes
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password', [NewPasswordController::class, 'store']);

// Email verification routes
Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->middleware('auth:sanctum');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('auth:sanctum');
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

// Confirm password route
Route::post('/password/confirm', [ConfirmablePasswordController::class, 'store'])->middleware('auth:sanctum');

// User registration route
Route::post('/register', [RegisteredUserController::class, 'store']);
