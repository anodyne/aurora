<?php namespace App\Data\Repositories;

use Reply as Model, ReplyRepositoryContract;

class ReplyRepository extends Repository implements ReplyRepositoryContract
{
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function create(array $data)
	{
		$reply = $this->model->create($data);

		// Fire an event

		return $reply;
	}
}
