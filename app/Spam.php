<?php namespace App;

class Spam
{
	public function detect($text)
	{
		$this->detectInvalidKeywords($text);

		return false;
	}

	protected function detectInvalidKeywords($text)
	{
		$invalidKeywords = [
			'yahoo customer support',
		];

		foreach ($invalidKeywords as $keyword) {
			if (stripos($text, $keyword) !== false) {
				throw new \Exception;
			}
		}
	}
}
