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

// Add like and dislike
Route::get('like/{id}', 'LikeController@store')->name('like');
Route::get('dislike/{id}', 'DislikeController@store')->name('dislike');

// Add, update and delete comment
Route::post('comments', 'CommentController@store')->name('comments.store');
Route::post('comments/{id}/edit', 'CommentController@update')->name('comments.update');
Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');

// Delete tag
Route::post('tags', 'TagController@store')->name('tag.store');
Route::delete('tags/delete/{id}', 'TagController@destroy')->name('tag.destroy');

// About & contact pages
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
