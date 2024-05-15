<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
// AuthAPIs
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

*/

// ArtikelAPIs
Route::get('/items', [ArticleController::class, 'index']);
Route::get('/items/{item}', [ArticleController::class, 'show']);
Route::post('/items', [ArticleController::class, 'store']);
Route::middleware('auth:sanctum')->put('/items/{item}', [ArticleController::class, 'update']);
Route::middleware('auth:sanctum')->get('/items/{item}/edit', [ArticleController::class, 'edit']);


//StartseiteAPIs 
Route::get('/beispiel', [ItemController::class, 'beispiel']);
Route::get('/homeitems', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'startPage']);

/*
//MessageAPIs
Route::middleware('auth')->group(function () {
   
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
    Route::get('/messages/create/{recipient}/{articleId}', [MessageController::class, 'create'])->name('messages.create')->middleware('auth');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('auth');
    Route::get('/messages/conversation/{user}/{articleId}', [MessageController::class, 'conversation'])->name('messages.conversation')->middleware('auth');
    Route::post('/messages/reply/{user}/{articleId}', [MessageController::class, 'reply'])->name('messages.reply')->middleware('auth');

});



//ProfilAPIs
Route::middleware('auth')->group(function () {
    Route::get('/profileEdit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profileEdit', [ProfileController::class, 'update'])->name('profileUpdate');
    Route::delete('/profileEdit', [ProfileController::class, 'destroy'])->name('profileDestroy');
    Route::delete('profile/items/{item}', [ProfileController::class, 'destroyItem'])->name('items.destroy');
   Route::post('/profile/updatepicture', [ProfileController::class, 'updatePicture'])->name('profile.updatepicture');
});

//Adminpanel
        //Userverwaltung
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::delete('/admin/users/{user}/confirm-destroy', [AdminController::class, 'confirmDestroyUser'])->name('admin.users.confirmDestroy');

        //Artikelverwaltung 
    Route::get('/admin/articles', [AdminController::class, 'listArticles'])->name('admin.articles.index');
    Route::get('/admin/articles/{item}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');
    Route::delete('/admin/articles/{item}', [AdminController::class, 'destroyArticle'])->name('admin.articles.destroy');
    Route::put('/admin/articles/{item}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::get('/admin/search', [AdminController::class, 'searchUser'])->name('admin.searchUser')->middleware('auth', 'is_admin');



    Route::get('/items', [ItemController::class, 'index']);
    
});
*/