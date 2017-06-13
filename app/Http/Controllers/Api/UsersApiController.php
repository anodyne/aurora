<?php namespace App\Http\Controllers\Api;

use App\Data\User;

class UsersApiController extends ApiController
{
	public function all()
	{
		return cache()->remember('anodyne.users', 60, function () {
			return User::get();
		});
	}
}
