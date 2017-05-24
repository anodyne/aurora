<?php namespace App\Data;

use Eloquent;

class DiscussionSubscription extends Eloquent
{
	protected $table = 'forum_discussions_subscriptions';
	protected $fillable = ['user_id', 'discussion_id'];
}
