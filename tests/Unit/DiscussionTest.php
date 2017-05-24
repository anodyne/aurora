<?php namespace Tests\Unit;

use Tests\DatabaseTestCase;

class DiscussionTest extends DatabaseTestCase
{
    protected $discussion;

    public function setUp()
    {
        parent::setUp();

        $this->discussion = create('App\Data\Discussion');
    }

    /** @test **/
    public function it_belongs_to_a_topic()
    {
        $this->assertInstanceOf('App\Data\Topic', $this->discussion->topic);
    }

    /** @test **/
    public function it_has_an_author()
    {
        $this->assertInstanceOf('App\Data\User', $this->discussion->author);
    }

    /** @test **/
    public function it_can_add_a_reply()
    {
        $this->discussion->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->discussion->replies);
    }

    /** @test **/
    public function it_has_replies()
    {
        $this->assertInstanceOf(
			'Illuminate\Database\Eloquent\Collection',
			$this->discussion->replies
		);
    }

    /** @test **/
    public function it_can_be_subscribed_to()
    {
    	$this->signIn();

    	// When the user subscribes to the discussion
    	$this->discussion->subscribe();

    	// Then we should be able to fetch all discussions the user has subscribed to
    	$this->assertEquals(
    		1,
    		$this->discussion->subscriptions()->where('user_id', auth()->id())->count()
    	);
    }

    /** @test **/
    public function it_can_be_unsubscribed_from()
    {
    	$this->signIn();

    	$this->discussion->subscribe();
    	
    	$this->discussion->unsubscribe();

    	$this->assertEquals(
    		0,
    		$this->discussion->subscriptions()->where('user_id', auth()->id())->count()
    	);
    }

    /** @test **/
    public function it_knows_if_the_authenticated_user_is_subscribed_to_it()
    {
    	$user = $this->createUser();

    	$this->signIn($user);

    	$this->assertFalse($this->discussion->isSubscribedTo);

    	$this->discussion->subscribe();

    	$this->assertTrue($this->discussion->isSubscribedTo);
    }
}
