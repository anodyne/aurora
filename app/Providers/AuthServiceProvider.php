<?php namespace App\Providers;

use Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	protected $policies = [
		'App\Data\Topic' => 'App\Policies\TopicPolicy',
	];

	public function boot()
	{
		$this->registerPolicies();

		// Grab all of the permissions, loop through them, and define the abilities
		$this->getPermissions()->each(function ($permission) {
			Gate::define($permission->name, function ($user) use ($permission) {
				return $user->hasRole($permission->roles->all());
			});
		});
	}

	protected function getPermissions()
	{
		return Permission::with('roles')->get();
	}
}
