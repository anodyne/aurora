<?php namespace App;

use App\Events\UserPointsWereUpdated;

trait AwardsExperiencePoints
{
	public function increment($column, $amount = 1, array $extra = [])
	{
		$oldPoints = $this->points;

		parent::increment($column, $amount, $extra);

		event(new UserPointsWereUpdated($this, $oldPoints));
	}
}
