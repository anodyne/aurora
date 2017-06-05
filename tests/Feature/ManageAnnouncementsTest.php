<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class ManageAnnouncementsTest extends DatabaseTestCase
{
	/** @test **/
	public function an_unauthorized_user_cannot_manage_announcements()
	{
		$this->withExceptionHandling();

		$topic = create('App\Data\Announcement');

		$this->get(route('announcements.index'))->assertRedirect(route('login'));
		$this->get(route('announcements.create'))->assertRedirect(route('login'));
		$this->post(route('announcements.store'))->assertRedirect(route('login'));
		$this->get(route('announcements.edit', $topic))->assertRedirect(route('login'));
		$this->put(route('announcements.update', $topic))->assertRedirect(route('login'));
		$this->delete(route('announcements.destroy', $topic))->assertRedirect(route('login'));

		$this->signIn();

		$this->get(route('announcements.index'))->assertStatus(403);
		$this->get(route('announcements.create'))->assertStatus(403);
		$this->post(route('announcements.store'))->assertStatus(403);
		$this->get(route('announcements.edit', $topic))->assertStatus(403);
		$this->put(route('announcements.update', $topic))->assertStatus(403);
		$this->delete(route('announcements.destroy', $topic))->assertStatus(403);

		$this->signIn($this->createModerator());

		$this->get(route('announcements.index'))->assertStatus(403);
		$this->get(route('announcements.create'))->assertStatus(403);
		$this->post(route('announcements.store'))->assertStatus(403);
		$this->get(route('announcements.edit', $topic))->assertStatus(403);
		$this->put(route('announcements.update', $topic))->assertStatus(403);
		$this->delete(route('announcements.destroy', $topic))->assertStatus(403);
	}

	/** @test **/
	public function an_authorized_user_can_create_an_announcement()
	{
		$this->withExceptionHandling();

		$this->signIn($this->createAdmin());

		$announcement = make('App\Data\Announcement');

		$this->get(route('announcements.index'))->assertSee('Announcements');
		$this->get(route('announcements.create'))->assertSee('Add Announcement');

		$response = $this->post(route('announcements.store'), $announcement->toArray());
		$this->get($response->headers->get('Location'))->assertSee($announcement->title);
	}

	/** @test **/
	public function an_authorized_user_can_update_an_announcement()
	{
		$this->withExceptionHandling();

		$this->signIn($this->createAdmin());

		$announcement = create('App\Data\Announcement');

		$this->get(route('announcements.index'))->assertSee('Announcements');
		$this->get(route('announcements.edit', $announcement))->assertSee('Edit Announcement');

		$response = $this->put(
			route('announcements.update', $announcement),
			['title' => 'Updated Announcement Title']
		);
		$this->get($response->headers->get('Location'))->assertSee('Updated Announcement Title');
	}

	/** @test **/
	public function an_authorized_user_can_delete_an_announcement()
	{
		$userAdmin = $this->createAdmin();
		$userModerator = $this->createModerator();

		$this->signIn($userAdmin);

		$announcement1 = create('App\Data\Announcement');

		$this->delete(route('announcements.destroy', $announcement1));
		$this->assertDatabaseMissing('forum_announcements', ['id' => $announcement1->id]);

		$this->signIn($userModerator);

		$this->withExceptionHandling();

		$announcement2 = create('App\Data\Announcement');

		$this->delete(route('announcements.destroy', $announcement2));
		$this->assertDatabaseHas('forum_announcements', [
			'id' => $announcement2->id
		]);
	}

	/** @test **/
	public function an_announcement_requires_a_title()
	{
		$this->publishAnnouncement(['title' => ''])
			->assertSessionHasErrors('title');
	}

	/** @test **/
	public function an_announcement_requires_a_body()
	{
		$this->publishAnnouncement(['body' => ''])
			->assertSessionHasErrors('body');
	}

	protected function publishAnnouncement(array $overrides = [])
	{
		$this->withExceptionHandling()->signIn($this->createAdmin());

		$announcement = create('App\Data\Announcement', $overrides);

		return $this->post(route('announcements.store'), $announcement->toArray());
	}
}
