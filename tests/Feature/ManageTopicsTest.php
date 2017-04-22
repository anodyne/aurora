<?php namespace Tests\Feature;

use Role;
use Tests\DatabaseTestCase;

class ManageTopicsTest extends DatabaseTestCase
{
	/** @test **/
	public function an_unauthorized_user_cannot_manage_topics()
	{
		$this->withExceptionHandling();

		$topic = create('App\Data\Topic');

		$this->get(route('topics.index'))
			->assertRedirect(route('login'));

		$this->get(route('topics.create'))
			->assertRedirect(route('login'));

		$this->post(route('topics.store'))
			->assertRedirect(route('login'));

		$this->get(route('topics.edit', $topic))
			->assertRedirect(route('login'));

		$this->put(route('topics.update', $topic))
			->assertRedirect(route('login'));

		$this->signIn();

		$this->get(route('topics.index'))
			->assertStatus(403);

		$this->get(route('topics.create'))
			->assertStatus(403);

		$this->post(route('topics.store'))
			->assertStatus(403);

		$this->get(route('topics.edit', $topic))
			->assertStatus(403);

		$this->put(route('topics.update', $topic))
			->assertStatus(403);
	}

	/** @test **/
	public function an_authorized_user_can_create_a_topic()
	{
		$userAdmin = $this->createAdmin();
		$userModerator = $this->createModerator();

		$this->signIn($userAdmin);

		$topic = make('App\Data\Topic');

		$this->get(route('topics.index'))->assertSee('Topics');
		$this->get(route('topics.create'))->assertSee('Add Topic');

		$response = $this->post(route('topics.store'), $topic->toArray());
		$this->get($response->headers->get('Location'))->assertSee($topic->name);

		$this->signIn($userModerator);

		$topic = make('App\Data\Topic');

		$this->get(route('topics.index'))->assertSee('Topics');
		$this->get(route('topics.create'))->assertSee('Add Topic');

		$response = $this->post(route('topics.store'), $topic->toArray());
		$this->get($response->headers->get('Location'))->assertSee($topic->name);
	}

	/** @test **/
	public function an_authorized_user_can_update_a_topic()
	{
		// TODO
	}

	/** @test **/
	public function an_authorized_user_can_delete_a_topic()
	{
		// TODO
	}

	/** @test **/
	public function discussions_are_reassigned_to_a_new_topic_when_a_topic_is_deleted()
	{
		// TODO
	}

	/** @test **/
	public function a_topic_requires_a_name()
	{
		$this->publishTopic(['name' => ''])
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
