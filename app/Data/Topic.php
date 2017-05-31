<?php namespace App\Data;

use Str;
use Eloquent;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Eloquent
{
	use SoftDeletes, PresentableTrait;

	protected $table = 'forum_topics';
	protected $fillable = ['name', 'slug', 'parent_id', 'color', 'description'];
	protected $presenter = Presenters\TopicPresenter::class;

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

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = (empty($value))
			? Str::slug($value)
			: $value;
	}

	public function scopeParents($query)
	{
		return $query->where('parent_id', '=', null);
	}
}
