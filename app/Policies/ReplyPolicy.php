<?php namespace App\Policies;

use App\Data\User;
use App\Data\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Reply $reply)
	{
		//
	}

	public function create(User $user)
	{
		//return $user->can('forums.discussion.create');
	}

	public function update(User $user, Reply $reply)
	{
		return $user->can('forums.reply.edit')
			or (int) $reply->user_id === (int) $user->id;
	}

	public function delete(User $user, Reply $reply)
	{
		return $user->can('forums.reply.delete');
	}
}