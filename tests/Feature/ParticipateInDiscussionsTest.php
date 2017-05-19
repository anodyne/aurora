<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class ParticipateInDiscussionsTest extends DatabaseTestCase
{
	/** @test */
	function unauthenticated_users_may_not_add_replies()
	{
		$this->withExceptionHandling()
			->post(route('discussions.replies', ['some-channel', 1]), [])
			->assertRedirect('/login');
	}

	/** @test **/
	public function an_authenticated_user_may_participate_in_forum_discussions()
	{
		$this->signIn();

		$discussion = create('App\Data\Discussion');

		$reply = make('App\Data\Reply');

		$this->post(
			route('discussions.replies', [$discussion->topic, $discussion]),
			$reply->toArray()
		);

		$this->assertDatabaseHas('replies', ['body' => $reply->body]);
	}

	/** @test **/
	public function a_reply_requires_a_body()
	{
		$this->withExceptionHandling()->signIn();

		$discussion = create('App\Data\Discussion');
		$reply = make('App\Data\Reply', [
			'body' => null,
			'discussion_id' => $discussion->id
		]);

		$this->post(
			route('discussions.replies', [$discussion->topic, $discussion]),
			$reply->toArray()
		)->assertSessionHasErrors('body');
	}

	/** @test **/
	public function unauthorized_users_cannot_delete_replies()
	{
		$this->withExceptionHandling();

		$reply = create('App\Data\Reply');

		$this->delete(route('replies.destroy', $reply))
			->assertRedirect(route('login'));

		$this->signIn($this->createUser());

		$this->delete(route('replies.destroy', $reply))
			->assertStatus(403);
	}

	/** @test **/
	public function authorized_users_can_delete_replies()
	{
		$moderator = $this->createModerator();
		$admin = $this->createAdmin();

		$reply1 = create('App\Data\Reply');

		$this->signIn($moderator);

		$this->delete(route('replies.destroy', $reply1))
			->assertStatus(302);
		
		$this->assertSoftDeleted('replies', ['id' => $reply1->id]);

		$reply2 = create('App\Data\Reply');

		$this->signIn($admin);

		$this->delete(route('replies.destroy', $reply2))
			->assertStatus(302);
		
		$this->assertSoftDeleted('replies', ['id' => $reply2->id]);
	}

	/** @test **/
	public function authorized_users_can_update_replies()
	{
		$this->signIn();

		$reply = create('App\Data\Reply', ['user_id' => auth()->id()]);

		$this->patch(route('replies.update', $reply), ['body' => 'Updated the body.']);
		
		$this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => 'Updated the body.']);
	}

	/** @test **/
	public function unauthorized_users_cannot_update_replies()
	{
		$this->withExceptionHandling();

		$reply = create('App\Data\Reply');

		$this->patch(route('replies.update', $reply), ['body' => 'Updated the body.'])
			->assertRedirect(route('login'));
	}

	// TODO: the_discussion_author_can_mark_a_reply_as_the_correct_answer
	// TODO: a_user_who_is_not_the_author_cannot_set_the_answer_reply
}
