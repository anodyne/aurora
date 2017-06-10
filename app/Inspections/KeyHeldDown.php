<?php namespace App\Inspections;

use Exception;

class KeyHeldDown implements Inspectable
{
	public function inspect($text, $model = null)
	{
		if (preg_match('/(.)\\1{4,}/', $text, $matches)) {
			throw new Exception('Too many repeating characters.');
		}
	}
}
