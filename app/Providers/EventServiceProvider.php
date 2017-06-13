<?php namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	protected $listen = [
		'App\Events\DiscussionHasNewReply' => [
			'App\Listeners\NotifyDiscussionSubscribersAboutNewReply',
		],

		'App\Events\DiscussionWasAnswered' => [
			'App\Listeners\NotifyReplyAuthorAboutAnswer',
			'App\Listeners\NotifyDiscussionSubscribersAboutAnswer',
		],

		'App\Events\ItemWasFavorited' => [
			'App\Listeners\NotifyItemAuthorAboutFavorite',
		],

		'App\Events\UserWasMentioned' => [
			'App\Listeners\NotifyMentionedUser',
		],

		'App\Events\UserPointsWereUpdated' => [
			'App\Listeners\NotifyUserAboutPointMilestones',
		],
	];

	protected $subscribe = [
		'App\Listeners\ExperiencePointsSubscriber',
	];

	public function boot()
	{
		parent::boot();
	}
}
