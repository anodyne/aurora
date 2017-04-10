<?php namespace App\Filters;

use App\Data\User;

class DiscussionFilters extends Filters
{
	protected $filters = ['by', 'popular'];

	protected function by($username)
	{
		// Find the first user with the username
		$user = User::username($username)->firstOrFail();
		
		return $this->builder->where('user_id', $user->id);
	}

	protected function popular()
	{
		// Clear out any existing ordering that we have
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('replies_count', 'desc');
	}
}
