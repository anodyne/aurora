<?php namespace App\Data\Contracts;

interface ReplyRepositoryContract extends RepositoryContract
{
	public function create(array $data);
}
