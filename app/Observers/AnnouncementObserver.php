<?php namespace App\Observers;

use App\Data\Announcement;
use App\Events\AnnouncementWasCreated;

class AnnouncementObserver extends Observer
{
	public function created(Announcement $announcement)
	{
		event(new AnnouncementWasCreated($announcement));
	}
}
