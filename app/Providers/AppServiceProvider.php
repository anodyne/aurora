<?php namespace App\Providers;

use Form;
use Schema;
use App\Data;
use App\Observers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function boot()
	{
		Schema::defaultStringLength(191);

		$this->app['view']->composer('*', function ($view) {
			$view->with('_user', auth()->user());
		});

		// Set the container bindings
		$this->bindings();

		// Set the model observers
		$this->setModelObservers();

		// Build any macros we have
		$this->macros();
	}

	public function register()
	{
		// Register any service providers or bindings that should only be used
		// in the local environment
		if ($this->app['env'] == 'local') {
			if (class_exists('Barryvdh\Debugbar\ServiceProvider')) {
				$this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
			}
		}

		// Register any service providers or bindings that should only be used
		// in the testing environment
		if ($this->app['env'] == 'testing') {
			if (class_exists('Laravel\Dusk\DuskServiceProvider')) {
				$this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
			}
		}
	}

	protected function bindings()
	{
		// Bind the Anodyne class into the container
		$this->app->singleton('anodyne', function ($app) {
			return new \App\Anodyne;
		});

		// Bind the avatar class into the container
		$this->app->bind('avatar', function ($app) {
			return new \App\Avatar;
		});

		// Bind the flash notifier class into the container
		$this->app->bind('flash', function ($app) {
			return new \App\FlashNotifier;
		});
	}

	protected function setModelObservers()
	{
		Data\Reply::observe(Observers\ReplyObserver::class);
		Data\Topic::observe(Observers\TopicObserver::class);
		Data\Favorite::observe(Observers\FavoriteObserver::class);
		Data\Discussion::observe(Observers\DiscussionObserver::class);
		Data\Announcement::observe(Observers\AnnouncementObserver::class);
	}

	protected function macros()
	{
		Form::macro('topics', function () {
			$topicsArr = [];
			$topics = Data\Topic::with('children')->parents()->get()->sortBy('name');

			foreach ($topics as $parent) {
				if ($parent->children->count() == 0) {
					$topicsArr[$parent->id] = $parent->name;
				} else {
					$topicsArr[$parent->name][$parent->id] = $parent->name;

					foreach ($parent->children as $child) {
						$topicsArr[$parent->name][$child->id] = $child->name;
					}
				}
			}

			return Form::select('topic_id', $topicsArr, null, ['class' => 'form-control', 'placeholder' => 'Choose a topic']);
		});
	}
}
