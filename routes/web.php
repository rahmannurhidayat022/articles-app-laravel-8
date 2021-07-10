<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
 Route::get('/', [SiteController::class, 'guestArticles'])->name('guest');
 Route::get('/guest/articles/{id}', [SiteController::class, 'guestArticlesDetail'])->name('detail');
 Route::post('/comments/new', [SiteController::class, 'addComments']);
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
 Route::get('/home', [SiteController::class, 'index'])->name('home');
 Route::get('/articles/detail/{id}', [SiteController::class, 'articlesDetail'])->name('detail');
 Route::match(['get', 'post'], '/articles/new/', [SiteController::class, 'articlesAdd'])->name('add');
 Route::match(['get', 'post'], '/articles/edit/{id}', [SiteController::class, 'articlesEdit'])->name('edit');
 Route::delete('/articles/delete/{id}', [SiteController::class, 'articlesDelete'])->name('delete');
 Route::post('/register/author', [SiteController::class, 'authors'])->name('authors');
});
