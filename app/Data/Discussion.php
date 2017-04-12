<?php namespace App\Data;

use Eloquent;
use DiscussionPresenter;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Eloquent
{
	use SoftDeletes, PresentableTrait;

	protected $fillable = ['title', 'body', 'user_id', 'topic_id'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $presenter = DiscussionPresenter::class;

	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope('replyCount', function ($builder) {
			$builder->withCount('replies');
		});

		static::addGlobalScope('answerCount', function ($builder) {
			$builder->withCount('answer');
		});
	}

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function answer()
	{
		return $this->hasOne(Reply::class, 'id', 'answer_id')
			->with('author')
			->withCount('favorites');
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function replies()
	{
		return $this->hasMany(Reply::class)
			->with('author')
			->withCount('favorites');
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	//--------------------------------------------------------------------------
	// Model Methods
	//--------------------------------------------------------------------------

	public function addReply(array $data)
	{
		$this->replies()->create($data);
	}

	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}
}
