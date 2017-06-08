<?php namespace App\Listeners;

use App\Events\ItemWasFavorited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ItemWasFavorited as ItemWasFavoritedNotification;

class NotifyItemAuthorOfFavorite
{
	public function handle(ItemWasFavorited $event)
	{
		$event->favorite
			  ->favorited
			  ->author
			  ->notify(new ItemWasFavoritedNotification($event->favorite));
	}
}
