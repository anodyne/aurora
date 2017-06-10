<?php namespace App\Events;

use App\Data\User;
use Illuminate\Queue\SerializesModels;

class UserWasMentioned
{
	use SerializesModels;

	public $user;
	public $model;

	public function __construct(User $user, $model)
	{
		$this->user = $user;
		$this->model = $model;
	}
}
