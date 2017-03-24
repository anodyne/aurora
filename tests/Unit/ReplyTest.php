<?php namespace Tests\Unit;

use Tests\DatabaseTestCase;

class ReplyTest extends DatabaseTestCase
{
	protected $reply;

	public function setUp()
	{
		parent::setUp();

		$this->reply = create('App\Data\Reply');
	}

    /** @test **/
    public function it_has_an_author()
    {
        $this->reply = create('App\Data\Reply');

        $this->assertInstanceOf('App\Data\User', $this->reply->author);
    }

	/** @test **/
	public function it_belongs_to_a_discussion()
	{
		$this->reply = create('App\Data\Reply');

		$this->assertInstanceOf('App\Data\Discussion', $this->reply->discussion);
	}
}
