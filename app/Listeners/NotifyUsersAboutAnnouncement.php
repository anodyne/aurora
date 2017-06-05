<?php namespace App\Listeners;

use App\Data\User;
use App\Events\AnnouncementWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\AnnouncementWasCreated as AnnouncementNotification;

class NotifyUsersAboutAnnouncement
{
	public function handle(AnnouncementWasCreated $event)
	{
		User::get()->each->notify(new AnnouncementNotification($event->announcement));
	}
}
