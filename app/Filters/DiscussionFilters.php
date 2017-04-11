<?php namespace App\Filters;

use Date;
use App\Data\User;

class DiscussionFilters extends Filters
{
	protected $filters = ['by', 'popular'];
	protected function answered()
	{
		return $this->builder->where('answer_id', '!=', null);
	}

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

	protected function trending()
	{
		// Clear out any existing ordering that we have
		$this->builder->getQuery()->orders = [];

		// Build the start date
		$start = Date::now()->subWeek();

		return $this->builder->where('created_at', '>=', $start)
			->orderBy('replies_count', 'desc');
	}
}
