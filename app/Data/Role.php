<?php namespace App\Data;

use Eloquent;

class Role extends Eloquent
{
	protected $table = 'core_roles';

	public function perms()
	{
		return $this->belongsToMany(Permission::class, 'core_permissions_roles');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'core_users_roles');
	}
}
