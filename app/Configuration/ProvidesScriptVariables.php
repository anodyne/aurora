<?php namespace App\Configuration;

use Status;

trait ProvidesScriptVariables
{
	public function scriptVariables()
	{
		// Grab the user so we can manually build the user object
		$currentUser = auth()->user();

		// Nova's system variables
		$system = ['system' => [
			'baseUrl' => app('request')->root(),
			'token' => csrf_token(),
		]];

		if ($currentUser) {
			$user = ['user' => [
				'name' => $currentUser->name,
				'username' => $currentUser->username,
				'email' => $currentUser->email,
				'points' => $currentUser->points,
			]];
		} else {
			$user = ['user' => [
				'name' => null,
				'username' => null,
				'email' => null,
				'points' => null,
			]];
		}

		return array_merge($system, $user);
	}
}
