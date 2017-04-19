<?php namespace Tests\Feature;

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

	/** @test **/
	public function an_authenticated_user_can_add_topics()
	{
		$this->signIn();

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
		$this->withExceptionHandling()->signIn();

		$topic = make('App\Data\Topic', $overrides);

		return $this->post(route('topics.store'), $topic->toArray());
	}
}
