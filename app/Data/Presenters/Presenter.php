<?php namespace App\Data\Presenters;

use Laracasts\Presenter\Presenter as BasePresenter;

abstract class Presenter extends BasePresenter
{
	public function createdAt()
	{
		return $this->entity->created_at->format();
	}

	public function createdDiff()
	{
		return $this->entity->created_at->diffForHumans();
	}

	public function deletedAt()
	{
		return $this->entity->deleted_at->format();
	}

	public function deletedDiff()
	{
		return $this->entity->deleted_at->diffForHumans();
	}

	public function updatedAt()
	{
		return $this->entity->updated_at->format();
	}

	public function updatedDiff()
	{
		return $this->entity->updated_at->diffForHumans();
	}
}
