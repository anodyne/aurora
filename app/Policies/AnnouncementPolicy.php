<?php namespace App\Policies;

use App\Data\User;
use App\Data\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
	use HandlesAuthorization;

	public function create(User $user)
	{
		return $user->can('forums.announcement.create');
	}

	public function update(User $user, Announcement $announcement)
	{
		return $user->can('forums.announcement.edit');
	}

	public function delete(User $user, Announcement $announcement)
	{
		return $user->can('forums.announcement.delete');
	}

	public function manage(User $user)
	{
		return $user->can('forums.announcement.create')
			or $user->can('forums.announcement.edit')
			or $user->can('forums.announcement.delete');
	}
}
