<?php namespace Tests\Feature;

use Tests\DatabaseTestCase;

class ParticipateInDiscussionsTest extends DatabaseTestCase
{
    /** @test */
    function unauthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post(route('discussions.replies', ['some-channel', 1]), [])
            ->assertRedirect('/login');
    }

    /** @test **/
    public function an_authenticated_user_may_participate_in_forum_discussions()
    {
        $this->signIn();

        $discussion = create('App\Data\Discussion');

        $reply = make('App\Data\Reply');

        $this->post(
            route('discussions.replies', [$discussion->topic->slug, $discussion]),
            $reply->toArray()
        );

        $this->get(route('discussions.show', [$discussion->topic->slug, $discussion]))
            ->assertSee($reply->body);
    }

    /** @test **/
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $discussion = create('App\Data\Discussion');
        $reply = make('App\Data\Reply', [
            'body' => null,
            'discussion_id' => $discussion->id
        ]);

        $this->post(
            route('discussions.replies', [$discussion->topic->slug, $discussion]),
            $reply->toArray()
        )->assertSessionHasErrors('body');
    }
}
