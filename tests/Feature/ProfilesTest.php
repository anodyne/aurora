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
		$this->signIn();

		$discussion = create('App\Data\Discussion', ['user_id' => auth()->id()]);

		$this->get(route('profile', auth()->user()))
			->assertSee($discussion->title);
	}
}
