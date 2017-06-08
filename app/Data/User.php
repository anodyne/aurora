<?php namespace App\Data;

use Date;
use UserPresenter;
use App\Authorization;
use App\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Authorizable, Authorization, Notifiable, PresentableTrait;

	protected $table = 'core_users';
	protected $fillable = ['points', 'signature'];
	protected $hidden = ['password', 'remember_token'];
	protected $presenter = Presenters\UserPresenter::class;

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function discussions()
	{
		return $this->hasMany(Discussion::class)->latest();
	}

	public function favorites()
	{
		return $this->hasMany(Favorite::class);
	}

	public function replies()
	{
		return $this->hasMany(Reply::class);
	}
	
	public function subscriptions()
	{
		return $this->hasMany(DiscussionSubscription::class);
	}

	//--------------------------------------------------------------------------
	// Model Methods
	//--------------------------------------------------------------------------

	public function getRouteKeyName()
	{
		return 'username';
	}

	public function scopeUsername($query, $username)
	{
		$query->where('username', $username);
	}

	public function read(Discussion $discussion)
	{
		cache()->forever(
			$this->visitedDiscussionCacheKey($discussion),
			Date::now()
		);
	}

	public function visitedDiscussionCacheKey(Discussion $discussion)
	{
		return sprintf('users.%s.visited.%s', $this->id, $discussion->id);
	}
}
