<?php namespace App\Providers;

use App\Data;
use App\Observers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function boot()
	{
		// Set the container bindings
		$this->bindings();

		// Set the model observers
		$this->setModelObservers();
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

	protected function repositoryBindings()
	{
		$app = $this->app;

		// Build a list of repositories that should be built
		collect(['Discussion', 'Reply'])->each(function ($binding) use (&$app) {
			// Set the concrete and abstract names
			$abstract = "{$binding}RepositoryContract";
			$abstractFQN = alias($abstract);
			$concrete = alias("{$binding}Repository");

			// Bind to the container and set the alias
			$app->bind($abstractFQN, $concrete);
			$app->alias($abstractFQN, $abstract);
		});
	}

	protected function setModelObservers()
	{
		Data\Reply::observe(Observers\ReplyObserver::class);
		Data\Topic::observe(Observers\TopicObserver::class);
		Data\Discussion::observe(Observers\DiscussionObserver::class);
	}
}
