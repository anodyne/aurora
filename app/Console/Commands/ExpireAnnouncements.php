<?php namespace App\Console\Commands;

use App\Data\Announcement;
use Illuminate\Console\Command;

class ExpireAnnouncements extends Command
{
	protected $signature = 'anodyne:expire-announcements';
	protected $description = 'Expire announcements and clear any notifications.';

	public function handle()
	{
		// Find all announcements with an expiration date before today
		$announcementIds = Announcement::where('expires_at', '<', Date::now()->startOfDay())
			->get()
			->map(function ($a) {
				return $a->id;
			});

		DB::table('forum_notifications')
			->whereIn('message->announcement_id', $announcementIds)
			->fill(['read_at' => Date::now()])
			->save();

		// Find all notifications with those IDs

		// Mark the notifications as read to clear them out

		if ($announcements->count() > 0) {
			//
		}
	}
}
