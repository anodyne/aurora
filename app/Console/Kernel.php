<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	protected $commands = [
		//Commands\ExpireAnnouncements::class
	];

	protected function schedule(Schedule $schedule)
	{
		//$schedule->command('anodyne:expire-announcements')->weekly();
	}

	protected function commands()
	{
		require base_path('routes/console.php');
	}
}
