<?php namespace App\Data;

use Eloquent;
use App\RecordsActivity;
use Laracasts\Presenter\PresentableTrait;

class Favorite extends Eloquent
{
	use PresentableTrait, RecordsActivity;

	protected $table = 'forum_favorites';
	protected $fillable = ['user_id', 'favorited_id', 'favorited_type'];
	protected $presenter = Presenters\FavoritePresenter::class;

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------
	
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function favorited()
	{
		return $this->morphTo();
	}
}
