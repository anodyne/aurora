<?php namespace App\Events;

use App\Data\Reply;
use App\Data\Discussion;
use Illuminate\Queue\SerializesModels;

class DiscussionHasNewReply
{
	use SerializesModels;

	public $discussion;
	public $reply;

	public function __construct(Discussion $discussion, Reply $reply)
	{
		$this->discussion = $discussion;
		$this->reply = $reply;
	}
}
