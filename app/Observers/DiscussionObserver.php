<?php namespace App\Observers;

use App\Data\Discussion;

class DiscussionObserver extends Observer
{
	public function created(Discussion $discussion)
	{
		// Record the activity for creating a discussion
		$this->recordActivity($discussion, 'created');
	}

	public function deleting(Discussion $discussion)
	{
		// Delete all the replies
		$discussion->replies()->delete();
	}
}
