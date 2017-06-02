<?php

Auth::routes();

Route::resource('discussions', 'DiscussionsController', ['except' => ['index']]);
Route::get('discussions/{topic}/{discussion}', 'DiscussionsController@show')
	->name('discussions.show');
Route::delete('discussions/{topic}/{discussion}', 'DiscussionsController@destroy')
	->name('discussions.destroy');

Route::get('/', 'DiscussionsController@index')->name('home');
Route::get('discussions/{topic}/{discussion}/replies', 'RepliesController@index')->name('replies.index');
Route::post('discussions/{topic}/{discussion}/replies', 'RepliesController@store')->name('discussions.replies');
Route::patch('replies/{reply}', 'RepliesController@update')->name('replies.update');
Route::delete('replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');

Route::post('discussions/{topic}/{discussion}/subscriptions', 'DiscussionSubscriptionsController@store')
	->name('subscriptions.store');
Route::delete('discussions/{topic}/{discussion}/subscriptions', 'DiscussionSubscriptionsController@destroy')
	->name('subscriptions.destroy');

Route::post('replies/{reply}/favorites', 'FavoritesController@store')->name('favorites.store');
Route::delete('replies/{reply}/favorites', 'FavoritesController@destroy')->name('favorites.destroy');

Route::get('user/{user}', 'ProfilesController@show')->name('profile');

Route::get('user/{user}/notifications', 'UserNotificationsController@index')->name('notifications.index');
Route::delete('user/{user}/notifications/{notification}', 'UserNotificationsController@destroy')
	->name('notifications.destroy');

Route::group(['prefix' => 'admin'], function () {
	app('router')->bind('deletedTopic', function ($value) {
		return App\Data\Topic::withTrashed()->where('slug', $value)->first();
	});

	Route::get('topics', 'TopicsController@index')->name('topics.index');
	Route::get('topics/create', 'TopicsController@create')->name('topics.create');
	Route::get('topics/{topic}/edit', 'TopicsController@edit')->name('topics.edit');
	Route::get('topics/{topic}/remove', 'TopicsController@remove')->name('topics.remove');
	Route::put('topics/{topic}', 'TopicsController@update')->name('topics.update');
	Route::put('topics/{deletedTopic}/restore', 'TopicsController@restore')
		->name('topics.restore');
	Route::post('topics', 'TopicsController@store')->name('topics.store');
	Route::delete('topics/{topic}', 'TopicsController@destroy')->name('topics.destroy');
});

Route::get('topics/{topic}', 'DiscussionsController@index')->name('topics.discussions');

Route::get('test', function () {
	auth()->setUser(User::find(85));
	view()->share('_user', auth()->user());

	return view('pages.test');
});
