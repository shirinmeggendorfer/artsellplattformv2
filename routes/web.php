<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/', [HomeController::class, 'startPage'])->name('startPage');

Route::get('/items/create', [ArticleController::class, 'createItem'])->name('items.createItem');
Route::get('/items/{item}', [ArticleController::class, 'show'])->name('items.show');
Route::post('/items', [ArticleController::class, 'store'])->name('items.storeItem');

Route::middleware('auth')->group(function () {
    Route::get('/profileEdit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profileEdit', [ProfileController::class, 'update'])->name('profileUpdate');
    Route::delete('/profileEdit', [ProfileController::class, 'destroy'])->name('profileDestroy');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
    Route::get('/messages/create/{recipient}/{articleId}', [MessageController::class, 'create'])->name('messages.create')->middleware('auth');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('auth');
    Route::get('/messages/conversation/{user}/{articleId}', [MessageController::class, 'conversation'])->name('messages.conversation')->middleware('auth');
    Route::post('/messages/reply/{user}/{articleId}', [MessageController::class, 'reply'])->name('messages.reply')->middleware('auth');

});

Route::get('/search', function () {
    return view('itemOverview');
})->name('itemOverview');


Route::get('/landing', function () {
    return view('landingPage');
})->name('landingPage');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware(['auth', 'is_admin']);


require __DIR__.'/auth.php';
