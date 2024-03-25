<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/', [HomeController::class, 'startPage'])->name('startPage');

Route::get('/items/create', [ArticleController::class, 'createItem'])->name('items.createItem');
Route::get('/items/{item}', [ArticleController::class, 'show'])->name('items.show');
Route::post('/items', [ArticleController::class, 'store'])->name('items.storeItem');
Route::put('/items/{item}', [ArticleController::class, 'update'])->name('items.update')->middleware('auth');
Route::get('/items/{item}/edit', [ArticleController::class, 'edit'])->name('items.edit')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profileEdit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profileEdit', [ProfileController::class, 'update'])->name('profileUpdate');
    Route::delete('/profileEdit', [ProfileController::class, 'destroy'])->name('profileDestroy');
    Route::delete('profile/items/{item}', [ProfileController::class, 'destroyItem'])->name('items.destroy');
   
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
    Route::get('/messages/create/{recipient}/{articleId}', [MessageController::class, 'create'])->name('messages.create')->middleware('auth');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('auth');
    Route::get('/messages/conversation/{user}/{articleId}', [MessageController::class, 'conversation'])->name('messages.conversation')->middleware('auth');
    Route::post('/messages/reply/{user}/{articleId}', [MessageController::class, 'reply'])->name('messages.reply')->middleware('auth');

});

Route::post('/profile/update-picture', [ProfileController::class, 'updatePicture'])->name('profile.update-picture');


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
Route::get('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
Route::get('/conversation/{conversationId}/read', [MessageController::class, 'markConversationAsRead'])->name('conversation.read');
Route::get('/check-new-messages', [MessageController::class, 'checkForNewMessages'])->name('messages.checkNew');




Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    
    Route::get('/admin/articles', [AdminController::class, 'listArticles'])->name('admin.articles.index');
    Route::get('/admin/articles/{item}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');
    Route::delete('/admin/articles/{item}', [AdminController::class, 'destroyArticle'])->name('admin.articles.destroy');
    Route::put('/admin/articles/{item}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::get('/admin/search', [AdminController::class, 'searchUser'])->name('admin.searchUser')->middleware('auth', 'is_admin');
    
});




require __DIR__.'/auth.php';
