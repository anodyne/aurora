<?php namespace App\Observers;

use App\Data\Reply;

class ReplyObserver extends Observer
{
	public function created(Reply $reply)
	{
		// Record the activity for creating a reply
		$this->recordActivity($reply, 'created');
	}
}
