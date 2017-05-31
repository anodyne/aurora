<?php namespace App\Data;

use Eloquent;
use App\Favoritable;
use App\RecordsActivity;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Eloquent
{
	use SoftDeletes, PresentableTrait, Favoritable, RecordsActivity;

	protected $table = 'forum_replies';
	protected $fillable = ['discussion_id', 'body', 'user_id'];
	protected $with = ['author', 'favorites'];
	protected $appends = ['favoritesCount', 'isFavorited'];
	protected $touches = ['discussion'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $presenter = Presenters\ReplyPresenter::class;

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

	public function isTheAnswer()
	{
		return $this->belongsTo(Discussion::class, 'id', 'answer_id');
	}
}
