<?php namespace App\Filters;

use App\Data\User;

class DiscussionFilters extends Filters
{
	protected $filters = ['by'];

	protected function by($username)
	{
		$user = User::where('name', $username)->firstOrFail();
		
		return $this->builder->where('user_id', $user->id);
	}
}