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

Route::post('replies/{reply}/favorites', 'FavoritesController@store')->name('favorites.store');

Route::get('user/{user}', 'ProfilesController@show')->name('profile');

Route::get('login', function () {
	//
})->name('auth.login');

Route::get('login', function () {
	//
})->name('login');

Route::get('test', function () {
	$user = User::find(1);

	dd($user->discussions);

	return view('pages.test');
});

Route::group(['prefix' => 'admin'], function () {
	Route::get('topics', 'TopicsController@index')->name('topics.index');
	Route::get('topics/create', 'TopicsController@create')->name('topics.create');
	Route::get('topics/{topic}/edit', 'TopicsController@edit')->name('topics.edit');
	Route::get('topics/{topic}/remove', 'TopicsController@remove')->name('topics.remove');
	Route::put('topics/{topic}', 'TopicsController@update')->name('topics.update');
	Route::put('topics/{topic}/restore', 'TopicsController@restore')->name('topics.restore');
	Route::post('topics', 'TopicsController@store')->name('topics.store');
	Route::delete('topics/{topic}', 'TopicsController@destroy')->name('topics.destroy');
});

Route::get('topics/{topic}', 'DiscussionsController@index')->name('topics.discussions');
