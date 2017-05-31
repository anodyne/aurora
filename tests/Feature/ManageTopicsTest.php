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

		$this->get(route('topics.index'))->assertRedirect(route('login'));
		$this->get(route('topics.create'))->assertRedirect(route('login'));
		$this->post(route('topics.store'))->assertRedirect(route('login'));
		$this->get(route('topics.edit', $topic))->assertRedirect(route('login'));
		$this->put(route('topics.update', $topic))->assertRedirect(route('login'));
		$this->put(route('topics.restore', $topic))->assertRedirect(route('login'));
		$this->delete(route('topics.destroy', $topic))->assertRedirect(route('login'));

		$this->signIn();

		$this->get(route('topics.index'))->assertStatus(403);
		$this->get(route('topics.create'))->assertStatus(403);
		$this->post(route('topics.store'))->assertStatus(403);
		$this->get(route('topics.edit', $topic))->assertStatus(403);
		$this->put(route('topics.update', $topic))->assertStatus(403);
		$this->put(route('topics.restore', $topic))->assertStatus(403);
		$this->delete(route('topics.destroy', $topic))->assertStatus(403);

		$this->signIn($this->createModerator());

		$this->get(route('topics.index'))->assertStatus(403);
		$this->get(route('topics.create'))->assertStatus(403);
		$this->post(route('topics.store'))->assertStatus(403);
		$this->get(route('topics.edit', $topic))->assertStatus(403);
		$this->put(route('topics.update', $topic))->assertStatus(403);
		$this->put(route('topics.restore', $topic))->assertStatus(403);
		$this->delete(route('topics.destroy', $topic))->assertStatus(403);
	}

	/** @test **/
	public function an_authorized_user_can_create_a_topic()
	{
		$this->withExceptionHandling();

		$this->signIn($this->createAdmin());

		$topic = make('App\Data\Topic');

		$this->get(route('topics.index'))->assertSee('Topics');
		$this->get(route('topics.create'))->assertSee('Add Topic');

		$response = $this->post(route('topics.store'), $topic->toArray());
		$this->get($response->headers->get('Location'))->assertSee($topic->name);
	}

	/** @test **/
	public function an_authorized_user_can_update_a_topic()
	{
		$this->withExceptionHandling();

		$this->signIn($this->createAdmin());

		$topic = create('App\Data\Topic');

		$this->get(route('topics.index'))->assertSee('Topics');
		$this->get(route('topics.edit', $topic))->assertSee('Edit Topic');

		$response = $this->put(route('topics.update', $topic), ['name' => 'Updated Topic Name']);
		$this->get($response->headers->get('Location'))->assertSee('Updated Topic Name');
	}

	/** @test **/
	public function an_authorized_user_can_delete_a_topic()
	{
		$userAdmin = $this->createAdmin();
		$userModerator = $this->createModerator();

		$this->signIn($userAdmin);

		$topic1 = create('App\Data\Topic');
		$topic2 = create('App\Data\Topic');

		$this->delete(route('topics.destroy', $topic1), ['newTopic' => $topic2->id]);
		$this->assertSoftDeleted('forum_topics', ['id' => $topic1->id]);

		$this->signIn($userModerator);

		$this->withExceptionHandling();

		$topic3 = create('App\Data\Topic');
		$topic4 = create('App\Data\Topic');

		$this->delete(route('topics.destroy', $topic3), ['newTopic' => $topic4->id]);
		$this->assertDatabaseHas('forum_topics', [
			'id' => $topic3->id,
			'deleted_at' => null
		]);
	}

	/** @test **/
	public function a_discussion_is_reassigned_to_a_new_topic_when_its_topic_is_deleted()
	{
		$this->signIn($this->createAdmin());

		$topic1 = create('App\Data\Topic');
		$topic2 = create('App\Data\Topic');
		$discussion = create('App\Data\Discussion', ['topic_id' => $topic1->id]);

		$this->delete(route('topics.destroy', $topic1), ['newTopic' => $topic2->id]);

		$this->assertDatabaseHas('forum_discussions', [
			'id' => $discussion->id,
			'topic_id' => $topic2->id
		]);
	}

	/** @test **/
	public function a_child_topic_is_reassigned_to_the_root_when_its_parent_topic_is_deleted()
	{
		$this->signIn($this->createAdmin());

		$topic1 = create('App\Data\Topic');
		$topic2 = create('App\Data\Topic', ['parent_id' => $topic1->id]);

		$this->delete(route('topics.destroy', $topic1), ['newTopic' => $topic2->id]);

		$this->assertDatabaseHas('forum_topics', [
			'id' => $topic2->id,
			'parent_id' => null
		]);
	}

	/** @test **/
	public function a_topic_can_be_restored()
	{
		$this->signIn($this->createAdmin());

		$topic = create('App\Data\Topic');
		$topic->delete();

		$this->assertSoftDeleted('forum_topics', ['id' => $topic->id]);

		$this->put(route('topics.restore', $topic));

		$this->assertDatabaseHas('forum_topics', [
			'id' => $topic->id,
			'deleted_at' => null
		]);
	}

	/** @test **/
	public function a_topic_requires_a_name()
	{
		$this->publishTopic(['name' => ''])
			->assertSessionHasErrors('name');
	}

	protected function publishTopic(array $overrides = [])
	{
		$this->withExceptionHandling()->signIn($this->createAdmin());

		$topic = create('App\Data\Topic', $overrides);

		return $this->post(route('topics.store'), $topic->toArray());
	}
}
