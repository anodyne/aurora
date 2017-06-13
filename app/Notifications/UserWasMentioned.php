<?php namespace App\Notifications;

use App\Data\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserWasMentioned extends Notification
{
	use Queueable;

	protected $model;

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function via($notifiable)
	{
		return ['database'];
	}

	public function toArray($notifiable)
	{
		if ($this->model instanceof Reply) {
			$discussion = $this->model->discussion;
			$linkAppend = "#reply-{$this->model->id}";
			$message = "{$this->model->author->name} mentioned you in a reply on the <em>{$discussion->title}</em> discussion.";
		} else {
			$discussion = $this->model;
			$linkAppend = false;
			$message = "{$this->model->author->name} mentioned you in the <em>{$discussion->title}</em> discussion.";
		}

		return [
			'message' => $message,
			'link' => route('discussions.show', [$discussion->topic, $discussion]).$linkAppend,
			'author' => $this->model->author,
		];
	}
}
