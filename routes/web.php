<?php

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

Route::get('/', 'GameController@index')->name('home');

Route::resource('games', 'GameController');

Route::get('like/{id}', 'LikeController@store')->name('like');
Route::get('dislike/{id}', 'DislikeController@store')->name('dislike');

Route::resource('comments', 'CommentController');
Route::delete('tags/delete/{id}', 'TagController@destroy')->name('tag.destroy');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
