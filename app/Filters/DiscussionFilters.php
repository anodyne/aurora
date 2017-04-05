<?php namespace App\Filters;

use App\Data\User;

class DiscussionFilters extends Filters
{
	protected $filters = ['by', 'popular'];

	protected function by($username)
	{
		$user = User::where('name', $username)->firstOrFail();
		
		return $this->builder->where('user_id', $user->id);
	}

	protected function popular()
	{
		// Clear out any existing ordering that we have
		$this->builder->getQuery()->orders = [];

		$this->builder->orderBy('replies_count', 'desc');
	}
}
