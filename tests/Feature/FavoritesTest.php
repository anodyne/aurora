<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class FavoritesTest extends DatabaseTestCase
{
	/** @test **/
	public function a_guest_cannot_favorite_anything()
	{
		$this->withExceptionHandling()
			->post('/replies/1/favorites')
			->assertRedirect(route('login'));
	}

	/** @test **/
	public function an_authenticated_user_can_favorite_any_reply()
	{
		$this->signIn();

		$reply = create('App\Data\Reply');

		$this->post(route('favorites.store', $reply));
		$this->assertCount(1, $reply->favorites);
	}

	/** @test **/
	public function an_authenticated_user_can_only_favorite_a_reply_once()
	{
		$this->signIn();

		$reply = create('App\Data\Reply');

		try {
			$this->post(route('favorites.store', $reply));
			$this->post(route('favorites.store', $reply));
		} catch (\Exception $e) {
			$this->fail('Did not expect to insert the same record set twice.');
		}

		$this->assertCount(1, $reply->favorites);
	}

	/** @test **/
	public function an_authenticated_user_can_unfavorite_a_reply()
	{
		//
	}
}
