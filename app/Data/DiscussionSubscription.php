<?php namespace App\Data;

use Eloquent;
use App\Data\Reply;
use App\Notifications\DiscussionWasUpdated;

class DiscussionSubscription extends Eloquent
{
	protected $table = 'forum_discussions_subscriptions';
	protected $fillable = ['user_id', 'discussion_id'];

	public function discussion()
	{
		return $this->belongsTo(Discussion::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function notify(Reply $reply)
	{
		return $this->user->notify(new DiscussionWasUpdated($this->discussion, $reply));
	}
}
