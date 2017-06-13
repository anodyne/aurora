<?php namespace App\Events;

use App\Data\User;
use Illuminate\Queue\SerializesModels;

class UserPointsWereUpdated
{
	use SerializesModels;

	public $user;
	public $oldPoints;

	public function __construct(User $user, $oldPoints)
	{
		$this->user = $user;
		$this->oldPoints = $oldPoints;
	}
}
