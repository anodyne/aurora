<?php namespace App\Inspections;

class InspectionManager
{
	protected $beforeInspectors = [
		Spam::class,
	];

	protected $afterInspectors = [
		Mentions::class,
	];

	public function inspectBefore($text)
	{
		foreach ($this->beforeInspectors as $inspector) {
			app($inspector)->inspect($text);
		}
	}

	public function inspectAfter($text, $model)
	{
		foreach ($this->afterInspectors as $inspector) {
			app($inspector)->inspect($text, $model);
		}
	}
}
