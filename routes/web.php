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

Route::resource('discussions', 'DiscussionsController', ['except' => ['index']]);
Route::get('discussions/{topic}/{discussion}', 'DiscussionsController@show')->name('discussions.show');

Route::get('/', 'DiscussionsController@index')->name('home');
Route::post('discussions/{topic}/{discussion}/replies', 'RepliesController@store')->name('discussions.replies');

Route::get('topics/{topic}', 'DiscussionsController@index')->name('topics.discussions');

Route::post('replies/{reply}/favorites', 'FavoritesController@store')->name('favorites.store');

Route::get('user/{username}', function () {
	//
})->name('profile');

Route::get('login', function () {
	//
})->name('auth.login');

Route::get('login', function () {
	//
})->name('login');

Route::get('test', function () {
	return view('pages.test');
});
