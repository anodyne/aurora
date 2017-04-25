<?php namespace App\Data;

use Eloquent;

class Activity extends Eloquent
{
	protected $fillable = ['user_id', 'type', 'subject_id', 'subject_type',
		'created_at'];

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function subject()
	{
		return $this->morphTo();
	}

	//--------------------------------------------------------------------------
	// Model Methods
	//--------------------------------------------------------------------------

	public static function feed(User $user)
	{
		return static::user($user)
			->latest()
			->with('subject')
			->take(50)
			->get()
			->groupBy(function ($activity) {
				return $activity->created_at->format('Y-m-d');
			});
	}

	public function scopeUser($query, User $user)
	{
		return $query->where('user_id', '=', $user->id);
	}
}
