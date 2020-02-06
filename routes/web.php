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

Route::view('/', 'welcome')->name('index');

//statuses Routes
Route::get('/statuses', 'StatusesController@index')->name('statuses.index');
Route::post('/statuses', 'StatusesController@store')->name('statuses.store')->middleware('auth');

//statuses Likes Routes
Route::post('/statuses/{status}/likes', 'StatusLikesController@store')->name('statuses.likes.store')->middleware('auth');
Route::delete('/statuses/{status}/likes', 'StatusLikesController@destroy')->name('statuses.likes.destroy')->middleware('auth');

//statuses comments Routes
Route::post('/statuses/{status}/comments', 'StatusCommentsController@store')->name('statuses.comments.store')->middleware('auth');

//comments Likes Routes
Route::post('/comments/{comment}/likes', 'CommentLikesController@store')->name('comments.likes.store')->middleware('auth');
Route::delete('/comments/{comment}/likes', 'CommentLikesController@destroy')->name('comments.likes.destroy')->middleware('auth');

//Users routes
Route::get('@{user}', 'UsersController@show')->name('users.show');


Route::get('/home', 'HomeController@index')->name('home');
Route::auth();
