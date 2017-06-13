<?php namespace App;

use App\Data\User;

class ExperiencePoints
{
	public function giveForBestAnswer(User $user)
	{
		$user->increment('points', 25);
	}

	public function giveForMarkingAnswer(User $user)
	{
		$user->increment('points', 10);
	}

	public function giveForNewDiscussion(User $user)
	{
		$user->increment('points', 5);
	}

	public function giveForNewReply(User $user)
	{
		$user->increment('points', 1);
	}
}
