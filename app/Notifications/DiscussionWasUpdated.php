<?php namespace App\Notifications;

use App\Data\Reply;
use App\Data\Discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiscussionWasUpdated extends Notification
{
	use Queueable;

	protected $discussion;
	protected $reply;

	public function __construct(Discussion $discussion, Reply $reply)
	{
		$this->discussion = $discussion;
		$this->reply = $reply;
	}

	public function via($notifiable)
	{
		return ['database'];
	}

	public function toArray($notifiable)
	{
		return [
			'message' => $this->reply->author->name.' added a reply to the <em>'.$this->discussion->title.'</em> discussion.',
			'link' => route('discussions.show', [$this->discussion->topic, $this->discussion]).'#reply-'.$this->reply->id,
			'author' => $this->reply->author,
		];
	}
}
