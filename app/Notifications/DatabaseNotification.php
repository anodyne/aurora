<?php namespace App\Notifications;

use Illuminate\Notifications\DatabaseNotification as BaseDatabaseNotification;

class DatabaseNotification extends BaseDatabaseNotification
{
	protected $table = 'forum_notifications';
}
