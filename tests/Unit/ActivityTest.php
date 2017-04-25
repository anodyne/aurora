<?php namespace Tests\Unit;

use Date;
use App\Data\Activity;
use Tests\DatabaseTestCase;

class ActivityTest extends DatabaseTestCase
{
	/** @test **/
	public function it_records_whenever_a_discussion_is_created()
	{
		$this->signIn();

		$discussion = create('App\Data\Discussion');

		$this->assertDatabaseHas('activities', [
			'type' => 'created_discussion',
			'user_id' => auth()->id(),
			'subject_id' => $discussion->id,
			'subject_type' => 'App\Data\Discussion',
		]);

		$activity = Activity::first();

		$this->assertEquals($activity->subject->id, $discussion->id);
	}

	/** @test **/
	public function it_records_whenever_a_reply_is_created()
	{
		$this->signIn();

		$reply = create('App\Data\Reply');

		$activity = Activity::latest()->first();

		$this->assertEquals(2, Activity::count());

		$this->assertDatabaseHas('activities', [
			'type' => 'created_reply',
			'user_id' => auth()->id(),
			'subject_id' => $reply->id,
			'subject_type' => 'App\Data\Reply',
		]);

		$this->assertEquals($activity->subject->id, $reply->id);
	}

	/** @test **/
	public function it_fetches_a_feed_for_any_user()
	{
		$this->signIn();

		create('App\Data\Discussion', ['user_id' => auth()->id()], 2);

		$feeds = Activity::user(auth()->user())->first()->update([
			'created_at' => Date::now()->subWeek()
		]);
		
		$feed = Activity::feed(auth()->user());

		$this->assertTrue($feed->keys()->contains(
			Date::now()->format('Y-m-d')
		));

		$this->assertTrue($feed->keys()->contains(
			Date::now()->subWeek()->format('Y-m-d')
		));
	}
}
