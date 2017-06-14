<?php

Auth::routes();

Route::resource('discussions', 'DiscussionsController', ['except' => ['index']]);
Route::get('discussions/{topic}/{discussion}', 'DiscussionsController@show')
	->name('discussions.show');
Route::delete('discussions/{topic}/{discussion}', 'DiscussionsController@destroy')
	->name('discussions.destroy');

Route::post('discussions/{topic}/{discussion}/answer', 'DiscussionAnswersController@store')
	->name('discussions.answer');

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

/**
 * Users
 */
Route::get('user/{user}', 'ProfilesController@show')->name('profile');
Route::get('user/{user}/notifications', 'UserNotificationsController@index')->name('notifications.index');
Route::delete('user/{user}/notifications', 'UserNotificationsController@destroyAll');
Route::delete('user/{user}/notifications/{notification}', 'UserNotificationsController@destroy')
	->name('notifications.destroy');

Route::get('leaderboard', 'LeaderboardController@index')->name('leaderboard');

Route::group(['prefix' => 'admin'], function () {
	/**
	 * Topic Management
	 */
	Route::resource('topics', 'TopicsController', ['except' => ['show']]);

	// Make sure for restoring we can get the actual object
	app('router')->bind('deletedTopic', function ($value) {
		return App\Data\Topic::withTrashed()->slug($value)->first();
	});

	// Add a route for restoring deleted topics
	Route::put('topics/{deletedTopic}/restore', 'TopicsController@restore')
		->name('topics.restore');
});

Route::get('topics/{topic}', 'DiscussionsController@index')->name('topics.discussions');

Route::get('test', function () {
	auth()->setUser(User::find(1));
	view()->share('_user', auth()->user());

	return view('pages.test');
});
