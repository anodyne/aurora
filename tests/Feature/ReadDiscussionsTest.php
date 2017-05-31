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
		$this->get(route('home'))
			->assertSee($this->discussion->title);
	}

	/** @test **/
	public function a_user_can_view_a_single_discussion()
	{
		$this->get(route('discussions.show', [$this->discussion->topic, $this->discussion]))
			->assertSee($this->discussion->title);
	}

	/** @test **/
	public function a_user_can_view_discussion_replies()
	{
		$reply = create('App\Data\Reply', [
			'discussion_id' => $this->discussion->id
		]);

		$this->assertDatabaseHas('forum_replies', ['body' => $reply->body]);
	}

	/** @test **/
	public function a_user_can_filter_discussions_by_topic()
	{
		$topic = create('App\Data\Topic');
		$discussionInTopic = create('App\Data\Discussion', ['topic_id' => $topic->id]);
		$discussionNotInTopic = create('App\Data\Discussion');

		$this->get(route('topics.discussions', [$topic]))
			->assertSee($discussionInTopic->title)
			->assertDontSee($discussionNotInTopic->title);
	}

	/** @test **/
	public function a_user_can_filter_discussions_by_user()
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

	/** @test **/
	public function a_user_can_request_all_replies_for_a_discussion()
	{
		$discussion = create('App\Data\Discussion');
		create('App\Data\Reply', ['discussion_id' => $discussion->id], 2);

		$response = $this->getJson(route('replies.index', [$discussion->topic, $discussion]))->json();

		$this->assertCount(2, $response['data']);
		$this->assertEquals(2, $response['total']);
	}

	// TODO: a_user_can_see_a_discussion_answer
}
