<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class SubscribeToDiscussionsTest extends DatabaseTestCase
{
	protected $discussion;

	public function setUp()
	{
		parent::setUp();

		$this->discussion = create('App\Data\Discussion');
	}

	/** @test **/
	public function a_user_can_subscribe_to_discussions()
	{
		$this->signIn();

		$this->post(route('subscriptions.store', [$this->discussion->topic, $this->discussion]));

		$this->assertCount(1, $this->discussion->fresh()->subscriptions);
	}

	/** @test **/
	public function a_user_can_unsubscribe_from_discussions()
	{
		$this->signIn();

		$this->discussion->subscribe();

		$this->delete(route('subscriptions.store', [$this->discussion->topic, $this->discussion]));

		$this->assertCount(0, $this->discussion->subscriptions);
	}
}
