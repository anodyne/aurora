<?php namespace App\Console\Commands;

use DB;
use Date;
use Illuminate\Console\Command;

class CleanupNotifications extends Command
{
	protected $signature = 'anodyne:cleanup-notifications';
	protected $description = 'Cleanup old read notifications';

	public function handle()
	{
		$this->line('Starting forum notification cleanup...');

		$delete = DB::table('forum_notifications')
			->whereNotNull('read_at')
			->where('read_at', '<', Date::today()->subMonth())
			->delete();

		$this->line('Finished forum notification cleanup.');
	}
}
