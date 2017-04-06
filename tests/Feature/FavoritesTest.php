<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class FavoritesTest extends DatabaseTestCase
{
	/** @test **/
	public function guests_cannot_favorite_anything()
	{
		$this->withExceptionHandling()
			->post("/replies/1/favorites")
			->assertRedirect(route('login'));
	}

	/** @test **/
	public function an_authenticated_user_can_favorite_any_reply()
	{
		$this->signIn();

		$reply = create('App\Data\Reply');

		$this->post("/replies/{$reply->id}/favorites");

		$this->assertCount(1, $reply->favorites);
	}

	/** @test **/
	public function an_authenticated_user_can_only_favorite_a_reply_once()
	{
		$this->signIn();

		$reply = create('App\Data\Reply');

		try {
			$this->post("/replies/{$reply->id}/favorites");
			$this->post("/replies/{$reply->id}/favorites");
		} catch (\Exception $e) {
			$this->fail('Did not expect to insert the same record set twice.');
		}

		$this->assertCount(1, $reply->favorites);
	}
}
