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

	public function title()
	{
		return $this->entity->title;
	}

	public function titleAsLink()
	{
		// Get the status for the discussion
		//$status = (auth()->check()) ? $this->entity->getStatusAttribute() : false;
		$status = ($this->entity->hasUpdatesFor()) ? ' updated' : false;

		return link_to_route(
			'discussions.show',
			$this->title(),
			[$this->entity->topic, $this->entity],
			['class' => "title{$status}"]
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
			: $this->entity->author;

		if ($author) {
			return link_to_route('profile', $author->present()->name, [$author->username]);
		}
	}
}
