<?php namespace App\Data;

use UserPresenter;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	protected $connection = 'users';
	protected $fillable = ['points'];
	protected $hidden = ['password', 'remember_token'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $presenter = UserPresenter::class;

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function discussions()
	{
		return $this->hasMany(Discussion::class);
	}

	public function replies()
	{
		return $this->hasMany(Reply::class);
	}

	//--------------------------------------------------------------------------
	// Model Scopes
	//--------------------------------------------------------------------------

	public function scopeUsername($query, $username)
	{
		$query->where('username', $username);
	}
}
