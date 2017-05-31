<?php namespace Tests;

use App\Data\Role;
use App\Exceptions\Handler;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	use CreatesApplication;

	protected $oldExceptionHandler;

	protected function setUp()
	{
		parent::setUp();

		$this->defineAuthorizationGates();

		$this->disableExceptionHandling();
	}

	protected function signIn($user = null)
	{
		$user = ($user) ?: create('App\Data\User');

		$this->actingAs($user);
	}

	protected function createUser()
	{
		$user = create('App\Data\User');
		$user->attachRole(Role::name('Forums User')->first());

		return $user;
	}

	protected function createAdmin()
	{
		$user = $this->createModerator();
		$user->attachRole(Role::name('Forums Administrator')->first());

		return $user;
	}

	protected function createModerator()
	{
		$user = $this->createUser();
		$user->attachRole(Role::name('Forums Moderator')->first());

		return $user;
	}

	protected function disableExceptionHandling()
	{
		$this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

		$this->app->instance(ExceptionHandler::class, new class extends Handler {
			public function __construct() {}
			public function report(\Exception $e) {}
			public function render($request, \Exception $e) {
				throw $e;
			}
		});
	}

	protected function withExceptionHandling()
	{
		$this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

		return $this;
	}

	protected function defineAuthorizationGates()
	{
		return (new AuthServiceProvider(app()))->defineGates();
	}
}
