<?php namespace App\Events;

use App\Data\Discussion;
use Illuminate\Queue\SerializesModels;

class DiscussionWasStarted
{
	use SerializesModels;

	public $discussion;

	public function __construct(Discussion $discussion)
	{
		$this->discussion = $discussion;
	}
}
