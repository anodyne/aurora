<?php namespace App\Data;

use Eloquent;

class Role extends Eloquent
{
	protected $connection = 'users';

	public function perms()
	{
		return $this->belongsToMany(Permission::class, 'permission_role');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'assigned_roles');
	}
}
