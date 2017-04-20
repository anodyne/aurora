<?php namespace App\Observers;

use App\Data\Discussion;

class DiscussionObserver
{
	public function deleting(Discussion $discussion)
	{
		// Delete all the replies
		$discussion->replies()->delete();
	}
}
