<?php namespace App\Observers;

use App\Data\Reply;

class ReplyObserver extends Observer
{
	public function created(Reply $reply)
	{
		// Update the discussion's reply count
		$reply->discussion->increment('replies_count');

		// Record the activity for creating a reply
		$this->recordActivity($reply, 'created');
	}

	public function deleting(Reply $reply)
	{
		// Delete all of the activity
		$reply->activity()->delete();
	}

	public function deleted(Reply $reply)
	{
		// Update the discussion's reply count
		$reply->discussion->decrement('replies_count');
	}
}
