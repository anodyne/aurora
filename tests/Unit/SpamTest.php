<?php namespace Tests\Unit;

use App\Inspections\Spam;
use Tests\DatabaseTestCase;

class SpamTest extends DatabaseTestCase
{
	protected $spam;

	public function setUp()
	{
		parent::setUp();

		$this->spam = new Spam;
	}

	/** @test **/
	public function it_checks_for_invalid_keywords()
	{
		$this->assertFalse($this->spam->detect('Innocent reply here.'));

		$this->expectException(\Exception::class);

		$this->spam->detect('Yahoo Customer Support');
	}

	/** @test **/
	public function it_checks_for_any_key_being_held_down()
	{
		$this->expectException(\Exception::class);

		$this->spam->detect('Hello world aaaaaaaa');
	}
}
