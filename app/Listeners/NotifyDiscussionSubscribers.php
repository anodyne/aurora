<?php namespace App\Listeners;

use App\Events\DiscussionHasNewReply;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyDiscussionSubscribers
{
	public function handle(DiscussionHasNewReply $event)
	{
		$event->discussion->subscriptions
			->where('user_id', '!=', $event->reply->user_id)
			->each
			->notify($event->reply);
	}
}
