<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class CreateDiscussionsTest extends DatabaseTestCase
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

	protected function publishDiscussion(array $overrides = [])
	{
		$this->withExceptionHandling()->signIn();

		$discussion = make('App\Data\Discussion', $overrides);

		return $this->post(route('discussions.store'), $discussion->toArray());
	}
}
