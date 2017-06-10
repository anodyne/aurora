<?php namespace App\Inspections;

class Spam
{
	protected $inspections = [
		InvalidKeywords::class,
		KeyHeldDown::class
	];

	public function inspect($text)
	{
		foreach ($this->inspections as $inspection) {
			app($inspection)->inspect($text);
		}

		return false;
	}
}
