<?php namespace App\Listeners;

use App\Events\DiscussionWasAnswered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ReplyWasChosenAsBestAnswer;

class NotifyReplyAuthorAboutAnswer
{
	public function handle(DiscussionWasAnswered $event)
	{
		$event->reply
			  ->author
			  ->notify(new ReplyWasChosenAsBestAnswer(
			  		$event->user,
			  		$event->reply,
			  		$event->discussion
			  	));
	}
}
