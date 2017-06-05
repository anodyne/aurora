<?php namespace App\Events;

use App\Data\Announcement;
use Illuminate\Queue\SerializesModels;

class AnnouncementWasCreated
{
	use SerializesModels;

	public $announcement;

	public function __construct(Announcement $announcement)
	{
		$this->announcement = $announcement;
	}
}
