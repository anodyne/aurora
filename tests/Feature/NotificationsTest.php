<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class NotificationsTest extends DatabaseTestCase
{
	/** @test **/
	public function a_notification_is_prepared_when_a_subscribed_discussion_receives_a_new_reply_that_is_not_by_the_current_user()
	{
		$this->signIn();

		$discussion = create('App\Data\Discussion')->subscribe();

		$this->assertCount(0, auth()->user()->notifications);

		$discussion->addReply([
			'user_id' => auth()->id(),
			'body' => 'Some content'
		]);

		$this->assertCount(0, auth()->user()->fresh()->notifications);

		$discussion->addReply([
			'user_id' => $this->createUser()->id,
			'body' => 'Some content'
		]);

		$this->assertCount(1, auth()->user()->fresh()->notifications);
	}

	/** @test **/
	public function a_user_can_fetch_their_unread_notifications()
	{
		$this->signIn();

		$discussion = create('App\Data\Discussion')->subscribe();

		$discussion->addReply([
			'user_id' => $this->createUser()->id,
			'body' => 'Some content'
		]);

		$response = $this->getJson(route('notifications.index', [auth()->user()]))->json();

		$this->assertCount(1, $response);
	}

	/** @test **/
	public function a_user_can_mark_a_notification_as_read()
	{
		$user = $this->createUser();

		$this->signIn($user);

		$discussion = create('App\Data\Discussion')->subscribe();

		$discussion->addReply([
			'user_id' => $this->createUser()->id,
			'body' => 'Some content'
		]);

		$this->assertCount(1, $user->unreadNotifications);

		$notificationId = $user->unreadNotifications->first()->id;

		$this->delete(route('notifications.destroy', [$user, $notificationId]));

		$this->assertCount(0, $user->fresh()->unreadNotifications);
	}
}
