<?php namespace App\Observers;

use App\Data\Favorite;

class FavoriteObserver extends Observer
{
	public function created(Favorite $favorite)
	{
		// Record the activity for creating a favorite
		$this->recordActivity($favorite, 'created');
	}

	public function deleting(Favorite $favorite)
	{
		// Delete all of the activity
		$favorite->activity()->delete();
	}
}
