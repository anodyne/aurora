<?php namespace App\Filters;

use Date;
use App\Data\User;

class DiscussionFilters extends Filters
{
	protected $filters = [
		'by',
		'popular',
		'trending',
		'answered',
		'subscribed',
		'updated',
	];

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

	protected function updated()
	{
		// Clear out any existing ordering that we have
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('updated_at', 'desc');
	}

	protected function popular()
	{
		// Clear out any existing ordering that we have
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('replies_count', 'desc');
	}

	protected function subscribed()
	{
		// Clear out any existing ordering that we have
		$this->builder->getQuery()->orders = [];

		return $this->builder
			->join('forum_discussions_subscriptions', 'forum_discussions.id', '=', 'forum_discussions_subscriptions.discussion_id')
			->where('forum_discussions_subscriptions.user_id', auth()->id());
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
