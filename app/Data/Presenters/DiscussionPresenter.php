<?php namespace App\Data\Presenters;

use Str;

class DiscussionPresenter extends Presenter
{
	public function author()
	{
		return $this->entity->author->present()->name;
	}

	public function authorAsLink()
	{
		return link_to_route('profile', $this->author(), [$this->entity->author->username]);
	}

	public function authorAvatar($linkToProfile = true, $size = 'sm')
	{
		return $this->entity->author->present()->avatar([
			'type' => 'link',
			'link' => route('profile', [$this->entity->author->username]),
			'class' => "avatar {$size}"
		]);
	}

	public function createdAt()
	{
		return "Started ".$this->entity->created_at->diffForHumans();
	}

	public function title()
	{
		return $this->entity->title;
	}

	public function titleAsLink()
	{
		// Get the status for the discussion
		//$status = (auth()->check()) ? $this->entity->getStatusAttribute() : false;
		$status = false;

		return link_to_route(
			'discussions.show',
			$this->title(),
			[$this->entity->topic, $this->entity],
			['class' => "list-item-title{$status}"]
		);
	}

	public function replyCount()
	{
		return sprintf('%02d', number_format($this->entity->replies_count));

		return partial('item-count', [
			'count'	=> $this->entity->replies_count,
			'label' => str_plural('reply', $this->entity->replies_count),
		]);
	}

	public function topic()
	{
		return $this->entity->topic->present()->nameAsLabel;
	}

	public function updatedAt()
	{
		if ($this->entity->replies_count > 0) {
			return "Updated ".$this->entity->updated_at->diffForHumans();
		}

		return $this->createdAt();
	}

	public function updatedBy()
	{
		// Grab the author of the last reply
		$author = ($this->entity->replies_count > 0)
			? $this->entity->replies->last()->author
			: false;

		if ($author) {
			return "by ".link_to_route('profile', $author->present()->name, [$author->username]);
		}
	}
}
