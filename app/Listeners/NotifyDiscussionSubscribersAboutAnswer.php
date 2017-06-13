<?php namespace App\Listeners;

use App\Events\DiscussionWasAnswered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\DiscussionWasAnswered as DiscussionWasAnsweredNotification;

class NotifyDiscussionSubscribersAboutAnswer
{
	public function handle(DiscussionWasAnswered $event)
	{
		$doNotNotify = [
			$event->user->id, // who marked the message as the best answer
			$event->reply->id, // the author of the reply chosen as the answer
		];

		$subscribers = $event->discussion->subscriptions
			->whereNotIn('user_id', $doNotNotify)
			->map(function ($subscription) {
				return $subscription->user;
			});

		// If an admin marked the reply as the best answer, so let the
		// discussion author know about that
		if ($event->user->id != $event->discussion->user_id) {
			$subscribers->push($event->discussion->author);
		}

		$subscribers->each(function ($user) use ($event) {
			$user->notify(new DiscussionWasAnsweredNotification(
				$event->user,
				$event->reply,
				$event->discussion
			));
		});
	}
}
