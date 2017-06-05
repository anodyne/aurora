<?php namespace App\Data;

use Eloquent;

class Announcement extends Eloquent
{
	protected $table = 'forum_announcements';
	protected $fillable = ['id', 'user_id', 'title', 'body', 'expires_at'];

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	//--------------------------------------------------------------------------
	// Model Methods
	//--------------------------------------------------------------------------

	public static function create(array $attributes = [])
	{
		$attributes = array_merge(['user_id' => auth()->id()], $attributes);

		return (new static)->newQuery()->create($attributes);
	}
}
