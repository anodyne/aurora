<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class NotificationsTest extends DatabaseTestCase
{
	public function setUp()
	{
		parent::setUp();

		$this->signIn();
	}

	/** @test **/
	public function a_notification_is_prepared_when_a_subscribed_discussion_receives_a_new_reply_that_is_not_by_the_current_user()
	{
		$user = auth()->user();

		$this->assertCount(0, $user->notifications);

		$discussion = create('App\Data\Discussion')->subscribe();

		$discussion->addReply([
			'user_id' => $user->id,
			'body' => 'Some reply here'
		]);

		$this->assertCount(0, $user->notifications);

		$discussion->addReply([
			'user_id' => $this->createUser()->id,
			'body' => 'Some reply here'
		]);

		$this->assertCount(1, $user->fresh()->notifications);
	}

	/** @test **/
	public function a_notification_is_prepared_when_a_new_favorite_is_left_on_a_reply()
	{
		$user1 = $this->createUser();
		$user2 = $this->createUser();

		$this->assertCount(0, $user1->notifications);

		$discussion = create('App\Data\Discussion');
		$reply = create('App\Data\Reply', ['user_id' => $user1->id]);

		$this->signIn($user2);

		$this->post(route('favorites.store', $reply));

		$this->assertCount(1, $user1->fresh()->notifications);
	}

	/** @test **/
	public function a_user_can_fetch_their_unread_notifications()
	{
		create('App\Notifications\DatabaseNotification');

		$this->assertCount(
			1,
			$this->getJson(route('notifications.index', [auth()->user()]))->json()
		);
	}

	/** @test **/
	public function a_user_can_mark_a_notification_as_read()
	{
		create('App\Notifications\DatabaseNotification');

		tap(auth()->user(), function ($user) {
			$this->assertCount(1, $user->unreadNotifications);

			$notificationId = $user->unreadNotifications->first()->id;

			$this->delete(route('notifications.destroy', [$user, $notificationId]));

			$this->assertCount(0, $user->fresh()->unreadNotifications);
		});
	}

	/** @test **/
	public function a_notification_is_prepared_when_a_user_is_mentioned()
	{
		$user1 = create('App\Data\User', ['username' => 'johnny']);
		$user2 = create('App\Data\User', ['username' => 'billy']);

		$discussion = make('App\Data\Discussion', [
			'user_id' => $user1->id,
			'body' => "@{$user2->username} hello world"
		]);

		$this->post(route('discussions.store'), $discussion->toArray());

		$this->assertCount(1, $user2->fresh()->notifications);
	}
}
