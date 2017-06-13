<?php namespace App\Listeners;

use App\ExperiencePoints;

class ExperiencePointsSubscriber
{
	public function subscribe($events)
	{
		$events->listen(
			'App\Events\DiscussionWasAnswered',
			'App\Listeners\ExperiencePointsSubscriber@onDiscussionAnswer'
		);

		$events->listen(
			'App\Events\DiscussionHasNewReply',
			'App\Listeners\ExperiencePointsSubscriber@onDiscussionReply'
		);

		$events->listen(
			'App\Events\DiscussionWasStarted',
			'App\Listeners\ExperiencePointsSubscriber@onDiscussionStart'
		);
	}

	public function onDiscussionAnswer($event)
	{
		$xp = new ExperiencePoints;

		$xp->giveForMarkingAnswer($event->user);

		$xp->giveForBestAnswer($event->reply->author);
	}

	public function onDiscussionStart($event)
	{
		(new ExperiencePoints)->giveForNewDiscussion($event->discussion->author);
	}

	public function onDiscussionReply($event)
	{
		(new ExperiencePoints)->giveForNewReply($event->reply->author);
	}
}
