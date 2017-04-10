<?php namespace App\Data\Contracts;

use Discussion;

interface DiscussionRepositoryContract extends RepositoryContract
{
	public function addReply(Discussion $discussion, array $data);
	public function create(array $data);
}
