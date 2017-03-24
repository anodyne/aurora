<?php namespace App\Data;

use Eloquent, TopicPresenter;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Eloquent
{
	use SoftDeletes, PresentableTrait;

	protected $fillable = ['name', 'slug'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $presenter = TopicPresenter::class;

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function discussions()
	{
		return $this->hasMany(Discussion::class);
	}

	//--------------------------------------------------------------------------
	// Model Methods
	//--------------------------------------------------------------------------

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
