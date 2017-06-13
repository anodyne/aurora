<?php namespace App\Listeners;

use App\Events\UserPointsWereUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserHitPointMilestone;

class NotifyUserAboutPointMilestones
{
	public function handle(UserPointsWereUpdated $event)
	{
		$user = $event->user;
		$oldPoints = $event->oldPoints;
		$newPoints = $user->points;

		$milestones = [100, 250, 500, 1000, 2500, 5000, 10000, 25000, 50000, 100000];

		foreach ($milestones as $milestone) {
			if ($oldPoints < $milestone and $newPoints >= $milestone) {
				$user->notify(new UserHitPointMilestone($user, $milestone, $newPoints));
			}
		}
	}
}
