<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class ReadDiscussionsTest extends DatabaseTestCase
{
	protected $discussion;

	public function setUp()
	{
		parent::setUp();

		$this->discussion = create('App\Data\Discussion');
	}

	/** @test **/
	public function a_user_can_view_all_discussions()
	{
		$this->get(route('home'))->assertSee($this->discussion->title);
	}

	/** @test **/
	public function a_user_can_view_a_single_discussion()
	{
		$this->get(route('discussions.show', [$this->discussion->topic->slug, $this->discussion]))
			->assertSee($this->discussion->title);
	}

	/** @test **/
	public function a_user_can_view_replies_associated_with_a_discussion()
	{
		$reply = create('App\Data\Reply', [
			'discussion_id' => $this->discussion->id
		]);

		$this->get(route('discussions.show', [$this->discussion->topic->slug, $this->discussion]))
			->assertSee($reply->body);
	}

	/** @test **/
	public function a_user_can_filter_discussions_according_to_a_topic()
	{
		$topic = create('App\Data\Topic');
		$discussionInTopic = create('App\Data\Discussion', ['topic_id' => $topic->id]);
		$discussionNotInTopic = create('App\Data\Discussion');

		$this->get(route('topics.discussions', [$topic]))
			->assertSee($discussionInTopic->title)
			->assertDontSee($discussionNotInTopic->title);
	}

	/** @test **/
	public function a_user_can_filter_discussions_by_any_username()
	{
		$user = create('App\Data\User');

		$this->signIn($user);

		$discussionByJohn = create('App\Data\Discussion', ['user_id' => $user->id]);
		$discussionNotByJohn = create('App\Data\Discussion');

		$this->get(route('home').'?by='.$user->username)
			->assertSee($discussionByJohn->title)
			->assertDontSee($discussionNotByJohn->title);
	}

	/** @test **/
	public function a_user_can_filter_discussions_by_popularity()
	{
		$discussionWithTwoReplies = create('App\Data\Discussion');
		create('App\Data\Reply', ['discussion_id' => $discussionWithTwoReplies->id], 2);

		$discussionWithThreeReplies = create('App\Data\Discussion');
		create('App\Data\Reply', ['discussion_id' => $discussionWithThreeReplies->id], 3);

		$discussionWithNoReplies = $this->discussion;

		$response = $this->getJson(route('home').'?popular=1')->json();

		$this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
	}
}
