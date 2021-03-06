<?php namespace App\Data;

use Eloquent;
use App\Events;
use App\RecordsActivity;
use App\AnswersDiscussion;
use Laracasts\Presenter\PresentableTrait;
use App\Notifications\DiscussionWasUpdated;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Eloquent
{
	use SoftDeletes, PresentableTrait, RecordsActivity, AnswersDiscussion;

	protected $table = 'forum_discussions';
	protected $fillable = ['title', 'body', 'user_id', 'topic_id', 'replies_count', 'answer_id'];
	protected $with = ['author', 'topic', 'subscriptions'];
	protected $appends = ['isSubscribedTo'];
	protected $presenter = Presenters\DiscussionPresenter::class;
	protected $observables = ['answered'];

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function replies()
	{
		return $this->hasMany(Reply::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(DiscussionSubscription::class);
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
		$reply = $this->replies()->create($data);

		if (auth()->check()) {
			auth()->user()->read($this);
		}

		return $reply;
	}

	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}

	public function scopeUser($query, User $user)
	{
		return $query->where('user_id', '=', $user->id);
	}

	public function subscribe()
	{
		$this->subscriptions()->create([
			'user_id' => auth()->id()
		]);

		return $this;
	}

	public function unsubscribe()
	{
		$this->subscriptions()->where('user_id', auth()->id())->delete();
	}

	public function getIsSubscribedToAttribute()
	{
		return $this->subscriptions
			->where('user_id', auth()->id())
			->count() > 0;
	}

	public function hasUpdatesFor(User $user = null)
	{
		$user = $user ?: auth()->user();

		if ($user === null) {
			return false;
		}

		return $this->updated_at > cache($user->visitedDiscussionCacheKey($this));
	}
}
