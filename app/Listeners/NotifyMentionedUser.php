<?php namespace App\Listeners;

use App\Events\UserWasMentioned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserWasMentioned as UserWasMentionedNotification;

class NotifyMentionedUser
{
	public function handle(UserWasMentioned $event)
	{
		$event->user->notify(new UserWasMentionedNotification($event->model));
	}
}
