<?php namespace App\Providers;

use Topic;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	public function boot()
	{
		view()->composer('layouts.app', function ($view) {
			return $view->with('_topics', Topic::get());
		});
	}

	public function register()
	{
		//
	}
}
