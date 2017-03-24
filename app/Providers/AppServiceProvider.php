<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->repositoryBindings();
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
}
