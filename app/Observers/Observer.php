<?php namespace App\Observers;

abstract class Observer
{
	public function recordActivity($model, $event)
	{
		// Don't record any activity if it's a guest
		if (auth()->guest()) {
			return;
		}

		// Record the activity
		$model->recordActivity($event);
	}
}
