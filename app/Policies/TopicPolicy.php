<?php namespace App\Policies;

use App\Data\User;
use App\Data\Discussion;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Discussion $discussion)
	{
		//
	}

	public function create(User $user)
	{
		return $user->can('forums.topic.create');
	}

	public function manage(User $user)
	{
		return $user->can('forums.topic.create')
			or $user->can('forums.topic.update')
			or $user->can('forums.topic.delete');
	}

	public function update(User $user, Discussion $discussion)
	{
		return $user->can('forums.topic.edit');
	}

	public function delete(User $user, Discussion $discussion)
	{
		return $user->can('forums.topic.delete');
	}
}