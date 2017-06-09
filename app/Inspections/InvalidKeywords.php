<?php namespace App\Inspections;

use Exception;

class InvalidKeywords implements Inspectable
{
	protected $keywords = [
		'yahoo customer support',
	];

	public function detect($text)
	{
		foreach ($this->keywords as $keyword) {
			if (stripos($text, $keyword) !== false) {
				throw new Exception('Your reply contains an invalid keyword.');
			}
		}
	}
}
