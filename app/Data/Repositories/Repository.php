<?php namespace App\Data\Repositories;

use RepositoryContract;

abstract class Repository implements RepositoryContract
{
	protected $model;

	public function all(array $with = [])
	{
		return $this->make($with)->get();
	}

	public function getById($id, array $with = [])
	{
		return $this->make($with)->find($id);
	}

	public function getFirstBy($column, $value, array $with = [])
	{
		return $this->make($with)->where($column, '=', $value)->first();
	}

	public function getManyBy($column, $value, array $with = [])
	{
		return $this->make($with)->where($column, '=', $value)->get();
	}

	public function make(array $with = [])
	{
		return $this->model->with($with);
	}
}
