<?php namespace Tests\Unit;

use App\Spam;
use Tests\DatabaseTestCase;

class SpamTest extends DatabaseTestCase
{
	/** @test **/
	public function it_validates_spam()
	{
		$spam = new Spam;

		$this->assertFalse($spam->detect('Innocent reply here.'));
	}
}
