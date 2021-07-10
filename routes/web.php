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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/guest', [SiteController::class, 'guestArticles'])->name('guest');
Route::get('/articles/detail/{id}', [App\Http\Controllers\SiteController::class, 'articlesDetail'])->name('detail');
Route::match(['get', 'post'], '/articles/new/', [App\Http\Controllers\SiteController::class, 'articlesAdd'])->name('add');
Route::match(['get', 'post'], '/articles/edit/{id}', [App\Http\Controllers\SiteController::class, 'articlesEdit'])->name('edit');
Route::delete('/articles/delete/{id}', [App\Http\Controllers\SiteController::class, 'articlesDelete'])->name('delete');
Route::post('/register/author', [App\Http\Controllers\SiteController::class, 'authors'])->name('authors');


Auth::routes();

Route::get('/home', [App\Http\Controllers\SiteController::class, 'index'])->name('home');
