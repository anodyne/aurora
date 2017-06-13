<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class ExperiencePointsTest extends DatabaseTestCase
{
	/** @test **/
	public function marking_a_reply_as_the_best_answer_awards_points()
	{
		$discussionAuthor = $this->createUser();
		$replyAuthor = $this->createUser();

		$discussion = create('App\Data\Discussion', [
			'user_id' => $discussionAuthor->id
		]);

		$reply = create('App\Data\Reply', [
			'discussion_id' => $discussion->id,
			'user_id' => $replyAuthor->id,
		]);

		$this->signIn($discussionAuthor);

		$discussion->markAsBestAnswer($reply->id);

		$this->assertEquals(15, $discussionAuthor->fresh()->points);
		$this->assertEquals(26, $replyAuthor->fresh()->points);
	}

	/** @test **/
	public function replying_to_a_discussion_awards_points()
	{
		$this->signIn();

		$discussion = create('App\Data\Discussion');

		$reply = create('App\Data\Reply', [
			'discussion_id' => $discussion->id,
			'user_id' => auth()->id()
		]);

		$this->assertEquals(1, auth()->user()->fresh()->points);
	}

	/** @test **/
	public function starting_a_discussion_awards_points()
	{
		$this->signIn();

		$discussion = create('App\Data\Discussion', [
			'user_id' => auth()->id()
		]);

		$this->assertEquals(5, auth()->user()->fresh()->points);
	}
}
