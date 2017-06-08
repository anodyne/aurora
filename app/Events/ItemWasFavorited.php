<?php namespace App\Events;

use App\Data\Favorite;
use Illuminate\Queue\SerializesModels;

class ItemWasFavorited
{
	use SerializesModels;

	public $favorite;

	public function __construct(Favorite $favorite)
	{
		$this->favorite = $favorite;
	}
}
