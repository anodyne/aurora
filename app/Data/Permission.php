<?php namespace App\Data;

use Eloquent;

class Permission extends Eloquent
{
	protected $connection = 'users';

	public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }	
}
