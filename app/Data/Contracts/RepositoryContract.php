<?php namespace App\Data\Contracts;

interface RepositoryContract
{
	public function all(array $with = []);
	public function getById($id, array $with = []);
	public function getFirstBy($column, $value, array $with = []);
	public function getManyBy($column, $value, array $with = []);
	public function make(array $with = []);
}
