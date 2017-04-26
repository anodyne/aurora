<?php namespace Tests\Feature;

use App\Data\Activity;
use Tests\DatabaseTestCase;

class ManageDiscussionsTest extends DatabaseTestCase
{
	/** @test **/
	public function a_guest_cannot_start_new_discussions()
	{
		$this->withExceptionHandling();

		$this->get(route('discussions.create'))
			->assertRedirect('/login');

		$this->post(route('discussions.store'))
			->assertRedirect('/login');
	}

	/** @test **/
	public function an_authenticated_user_can_start_new_discussions()
	{
		$this->signIn();

		$discussion = make('App\Data\Discussion');

		$response = $this->post(route('discussions.store'), $discussion->toArray());

		$this->get($response->headers->get('Location'))
			->assertSee($discussion->title)
			->assertSee($discussion->body);
	}

	/** @test **/
	public function an_authenticated_user_can_view_the_create_discussions_page()
	{
		$this->signIn();

		$this->get(route('discussions.create'))
			->assertSee('Start a Discussion');
	}

	/** @test **/
	public function a_discussion_requires_a_title()
	{
		$this->publishDiscussion(['title' => null])
			->assertSessionHasErrors('title');
	}

	/** @test **/
	public function a_discussion_requires_a_body()
	{
		$this->publishDiscussion(['body' => null])
			->assertSessionHasErrors('body');
	}

	/** @test **/
	public function a_discussion_requires_a_valid_topic_id()
	{
		factory('App\Data\Topic', 2)->create();

		$this->publishDiscussion(['topic_id' => null])
			->assertSessionHasErrors('topic_id');

		$this->publishDiscussion(['topic_id' => 999])
			->assertSessionHasErrors('topic_id');

		$this->publishDiscussion(['topic_id' => 'foo'])
			->assertSessionHasErrors('topic_id');
	}

	/** @test **/
	public function unauthorized_users_cannot_delete_discussions()
	{
		$this->withExceptionHandling();

		$discussion = create('App\Data\Discussion');

		$this->delete(route('discussions.destroy', [$discussion->topic, $discussion]))
			->assertRedirect(route('login'));

		$this->signIn();

		$this->delete(route('discussions.destroy', [$discussion->topic, $discussion]))
			->assertStatus(403);
	}

	/** @test **/
	public function authorized_users_can_delete_discussions()
	{
		$this->signIn();

		$discussion = create('App\Data\Discussion', ['user_id' => auth()->id()]);
		$reply = create('App\Data\Reply', ['discussion_id' => $discussion->id]);

		$response = $this->json('DELETE', route('discussions.destroy', [$discussion->topic, $discussion]));

		$response->assertStatus(204);

		$this->assertSoftDeleted('discussions', ['id' => $discussion->id]);
		$this->assertSoftDeleted('replies', ['id' => $reply->id]);
		$this->assertEquals(0, Activity::count());
	}

	protected function publishDiscussion(array $overrides = [])
	{
		$this->withExceptionHandling()->signIn();

		$discussion = make('App\Data\Discussion', $overrides);

		return $this->post(route('discussions.store'), $discussion->toArray());
	}
}
