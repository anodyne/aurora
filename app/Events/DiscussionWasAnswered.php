<?php namespace App\Events;

use App\Data\User;
use App\Data\Reply;
use App\Data\Discussion;
use Illuminate\Queue\SerializesModels;

class DiscussionWasAnswered
{
	use SerializesModels;

	public $user;
	public $discussion;
	public $reply;

	public function __construct(User $user, Discussion $discussion, Reply $reply)
	{
		$this->user = $user;
		$this->discussion = $discussion;
		$this->reply = $reply;
	}
}
