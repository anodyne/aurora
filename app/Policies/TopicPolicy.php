<?php namespace App\Policies;

use User;

class TopicPolicy extends Policy
{
	public function create(User $user)
	{
		return $user->can('forums.topic.create');
	}

	public function delete(User $user)
	{
		return $user->can('forums.topic.delete');
	}

	public function manage(User $user)
	{
		return $this->create($user) or $this->delete($user) or $this->update($user);
	}

	public function update(User $user)
	{
		return $user->can('forums.topic.edit');
	}
}
