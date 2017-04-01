<?php namespace App\Data;

use Eloquent;
use TopicPresenter;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Eloquent
{
	use SoftDeletes, PresentableTrait;

	protected $fillable = ['name', 'slug', 'parent_id', 'color'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $presenter = TopicPresenter::class;

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function children()
	{
		return $this->hasMany(self::class, 'parent_id', 'id');
	}

	public function discussions()
	{
		return $this->hasMany(Discussion::class);
	}

	public function parent()
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	//--------------------------------------------------------------------------
	// Model Methods
	//--------------------------------------------------------------------------

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
