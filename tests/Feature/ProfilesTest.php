<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class ProfilesTest extends DatabaseTestCase
{
	/** @test **/
	public function a_user_has_a_profile()
	{
		$user = $this->createUser();

		$this->get(route('profile', $user))
			->assertSee($user->name);
	}

	/** @test **/
	public function profiles_display_all_discussions_by_the_user()
	{
		$user = $this->createUser();

		$discussion = create('App\Data\Discussion', ['user_id' => $user->id]);

		$this->get(route('profile', $user))
			->assertSee($discussion->title);
	}
}
