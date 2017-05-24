<?php namespace App\Data;

use Eloquent;

class Role extends Eloquent
{
	protected $table = 'core_roles';

	public function perms()
	{
		return $this->belongsToMany(Permission::class, 'core_permission_role');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'core_assigned_roles');
	}
}
