<?php namespace App;

use ReflectionClass;
use App\Data\Activity;

trait RecordsActivity
{
	public function activity()
	{
		return $this->morphMany(Activity::class, 'subject');
	}

	public function recordActivity($event)
	{
		$shortName = strtolower((new ReflectionClass($this))->getShortName());

		$this->activity()->create([
			'type' => "{$event}_{$shortName}",
			'user_id' => auth()->id(),
		]);
	}
}
