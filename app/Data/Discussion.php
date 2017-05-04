<?php namespace App\Data;

use Eloquent;
use DiscussionPresenter;
use App\RecordsActivity;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Eloquent
{
	use SoftDeletes, PresentableTrait, RecordsActivity;

	protected $fillable = ['title', 'body', 'user_id', 'topic_id'];
	protected $with = ['author', 'topic'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $presenter = DiscussionPresenter::class;
	protected $observables = ['answered'];

	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope('replyCount', function ($builder) {
			$builder->withCount('replies');
		});
	}

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	/*public function answer()
	{
		return $this->hasOne(Reply::class, 'id', 'answer_id');
	}*/

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function replies()
	{
		return $this->hasMany(Reply::class);
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

	public function answer()
	{
		return $this->replies->where('id', $this->answer_id)->first();
	}

	public function isAnswered()
	{
		return $this->answer_id !== null;
	}

	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}

	public function scopeUser($query, User $user)
	{
		return $query->where('user_id', '=', $user->id);
	}
}
