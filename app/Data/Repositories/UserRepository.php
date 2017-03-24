<?php namespace App\Data\Repositories;

use User as Model, UserRepositoryContract;

class UserRepository extends Repository implements UserRepositoryContract
{
	public function __construct(Model $model)
	{
		$this->model = $model;
	}
}
