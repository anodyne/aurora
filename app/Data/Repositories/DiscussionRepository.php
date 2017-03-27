<?php namespace App\Data\Repositories;

use Discussion as Model;
use ReplyRepositoryContract;
use DiscussionRepositoryContract;

class DiscussionRepository extends Repository implements DiscussionRepositoryContract
{
	protected $replies;

	public function __construct(Model $model, ReplyRepositoryContract $replies)
	{
		$this->model = $model;
		$this->replies = $replies;
	}

	public function addReply(Model $discussion, array $data)
	{
		return $discussion->replies()->save($this->replies->create($data));
	}

	public function create(array $data)
	{
		$discussion = $this->model->create($data);

		// Fire an event

		return $discussion;
	}
}
