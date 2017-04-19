<?php namespace App;

use Role;

trait Authorization
{
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'assigned_roles', 'user_id', 'role_id');
	}

	public function hasRole($role, $requireAll = false)
	{
		if (is_array($role)) {
			foreach ($role as $r) {
				$hasRole = $this->hasRole($r->name);

				if ($hasRole and ! $requireAll) {
					return true;
				} elseif (! $hasRole and $requireAll) {
					return false;
				}
			}

			// If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
			// If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
			// Return the value of $requireAll;
			return $requireAll;
		} else {
			if ($this->roles->where('name', $role)->count() > 0) {
				return true;
			}
		}

		return false;
	}
	
	public function attachRole($role)
	{
		if (is_object($role)) {
			$role = $role->getKey();
		}

		if (is_array($role)) {
			$role = $role['id'];
		}

		$this->roles()->attach($role);
	}

	public function detachRole($role)
	{
		if (is_object($role)) {
			$role = $role->getKey();
		}

		if (is_array($role)) {
			$role = $role['id'];
		}

		$this->roles()->detach($role);
	}

	public function attachRoles($roles)
	{
		foreach ($roles as $role) {
			$this->attachRole($role);
		}
	}

	public function detachRoles($roles)
	{
		foreach ($roles as $role) {
			$this->detachRole($role);
		}
	}
}
