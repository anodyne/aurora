<?php namespace App\Observers;

use Cache;
use App\Data\Topic;

class TopicObserver
{
	public function saved(Topic $topic)
	{
		// Clear out the old cache item
		Cache::forget('topics');

		// Re-cache everything
		Cache::rememberForever('topics', function () {
			return Topic::with('children')->get();
		});
	}
}
