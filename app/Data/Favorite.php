<?php namespace App\Data;

use Eloquent;
use FavoritePresenter;
use App\RecordsActivity;
use Laracasts\Presenter\PresentableTrait;

class Favorite extends Eloquent
{
	use PresentableTrait, RecordsActivity;

	protected $table = 'favorites';
	protected $fillable = ['user_id', 'favorited_id', 'favorited_type'];
	protected $presenter = FavoritePresenter::class;

	public function favorited()
	{
		return $this->morphTo();
	}
}
