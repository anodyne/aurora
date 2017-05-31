<?php namespace App\Notifications;

use App\Data\Reply;
use App\Data\Discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

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

	public function toMail($notifiable)
	{
		return (new MailMessage)
					->line('The introduction to the notification.')
					->action('Notification Action', url('/'))
					->line('Thank you for using our application!');
	}

	public function toArray($notifiable)
	{
		return [
			'message' => "Temporary placeholder"
		];
	}
}
