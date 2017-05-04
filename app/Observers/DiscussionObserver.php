<?php namespace App\Observers;

use App\Data\Discussion;

class DiscussionObserver extends Observer
{
	public function answered(Discussion $discussion)
	{
		\Log::info('Discussion answered!');
	}

	public function created(Discussion $discussion)
	{
		// Record the activity for creating a discussion
		$this->recordActivity($discussion, 'created');
	}

	public function deleting(Discussion $discussion)
	{
		// Delete all the replies
		$discussion->replies->each->delete();

		// Delete all of the activity
		$discussion->activity()->delete();
	}
}
