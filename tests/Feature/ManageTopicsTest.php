<?php namespace Tests\Feature;

use Role;
use Tests\DatabaseTestCase;

class ManageTopicsTest extends DatabaseTestCase
{
	/** @test **/
	public function a_guest_cannot_add_topics()
	{
		$this->withExceptionHandling();

		$this->get(route('topics.index'))
			->assertRedirect('/login');

		$this->post(route('topics.store'))
			->assertRedirect('/login');
	}

	// an_authorized_user_can_add_topics
	// an_unauthorized_user_cannot_add_topics

	/** @test **/
	public function an_authenticated_user_can_add_topics()
	{
		$user = create('App\Data\User');
		$user->attachRole(Role::find(10));

		$this->signIn($user);

		$topic = make('App\Data\Topic');

		$response = $this->post(route('topics.store'), $topic->toArray());

		$this->get($response->headers->get('Location'))
			->assertSee($topic->name);
	}

	/** @test **/
	public function a_topic_requires_a_name()
	{
		$this->publishTopic(['name' => null])
			->assertSessionHasErrors('name');
	}

	protected function publishTopic(array $overrides = [])
	{
		$user = create('App\Data\User');
		$user->attachRole(Role::find(10));

		$this->withExceptionHandling()->signIn($user);

		$topic = create('App\Data\Topic', $overrides);

		return $this->post(route('topics.store'), $topic->toArray());
	}
}
