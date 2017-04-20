<?php namespace App\Policies;

use App\Data\User;
use App\Data\Discussion;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussionPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Discussion $discussion)
	{
		//
	}

	public function create(User $user)
	{
		//return $user->can('forums.discussion.create');
	}

	public function update(User $user, Discussion $discussion)
	{
		//return $user->can('forums.discussion.update');
		return $discussion->user_id == $user->id;
	}

	public function delete(User $user, Discussion $discussion)
	{
		//return $user->can('forums.discussion.delete');
	}
}
