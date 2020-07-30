<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('posts', 'PostController', ["except" => 'show']);
# это и есть posts.show
Route::get('/posts/{id}/', 'PostController@ref')->name('post.ref');
# это так же и главная страница
Route::get('/', 'HomeController@ref')->name('ref.home');
