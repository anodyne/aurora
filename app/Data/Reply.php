<?php namespace App\Data;

use Eloquent;
use ReplyPresenter;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Eloquent
{
	use SoftDeletes, PresentableTrait;

	protected $table = 'replies';
	protected $fillable = ['discussion_id', 'body', 'user_id'];
	protected $touches = ['discussion'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $presenter = ReplyPresenter::class;

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function discussion()
	{
		return $this->belongsTo(Discussion::class);
	}

	public function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	//--------------------------------------------------------------------------
	// Model Methods
	//--------------------------------------------------------------------------

	public function favorite()
	{
		$attributes = ['user_id' => auth()->id()];

		if (! $this->favorites()->where($attributes)->exists()) {
			return $this->favorites()->create($attributes);
		}
	}
}
