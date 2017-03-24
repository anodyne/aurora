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
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->discussion->replies);
    }
}
