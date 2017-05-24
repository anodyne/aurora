<?php namespace App\Data;

use Eloquent;

class Permission extends Eloquent
{
	protected $table = 'core_permissions';

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'core_permission_role');
	}
}
