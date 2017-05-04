<?php namespace App\Data\Presenters;

use Markdown;

class UserPresenter extends Presenter
{
	public function answerCount()
	{
		return number_format($this->entity->correctAnswers()->count());
	}

	public function discussionCount()
	{
		return number_format($this->entity->discussions->count());
	}

	public function email()
	{
		return $this->entity->email;
	}

	public function name()
	{
		return $this->entity->name;
	}

	public function points()
	{
		return number_format($this->entity->points).' XP';
	}

	public function postCount()
	{
		return number_format($this->entity->posts->count());
	}

	public function signature()
	{
		return $this->entity->signature;
	}
}
