<?php namespace Tests\Unit;

use Tests\DatabaseTestCase;

class TopicTest extends DatabaseTestCase
{
	/** @test **/
	public function it_has_discussions()
	{
		$topic = create('App\Data\Topic');
		$discussion = create('App\Data\Discussion', ['topic_id' => $topic->id]);

		$this->assertTrue($topic->discussions->contains($discussion));
	}
}
