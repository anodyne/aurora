<?php namespace App\Data\Presenters;

use Laracasts\Presenter\Presenter as BasePresenter;

abstract class Presenter extends BasePresenter
{
	public function created($format = null): string
	{
		return $this->formatDate($format, $this->entity->created_at);
	}

	public function deleted($format = null): string
	{
		return $this->formatDate($format, $this->entity->deleted_at);
	}

	public function updated($format = null): string
	{
		return $this->formatDate($format, $this->entity->updated_at);
	}

	protected function formatDate($format, $entity)
	{
		switch ($format) {
			case 'date':
				return $entity->format('d M Y');
				break;

			case 'raw':
				return $entity;
				break;

			case 'relative':
				return $entity->diffForHumans();
				break;

			case 'time':
				return $entity->format('g:ia');
				break;

			case 'time24':
				return $entity->format('H:i');
				break;

			default:
				return $entity->format('d M Y @ g:ia');
				break;
		}
	}
}
