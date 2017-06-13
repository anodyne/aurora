<?php namespace App\Notifications;

use App\Data\User;
use App\Data\Reply;
use App\Data\Discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReplyWasChosenAsBestAnswer extends Notification
{
	use Queueable;

	protected $user;
	protected $reply;
	protected $discussion;

	public function __construct(User $user, Reply $reply, Discussion $discussion)
	{
		$this->user = $user;
		$this->reply = $reply;
		$this->discussion = $discussion;
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
			'message' => $this->user->name.' marked your reply to the <em>'.$this->discussion->title.'</em> discussion as the best answer.',
			'link' => route('discussions.show', [$this->discussion->topic, $this->discussion]).'#reply-'.$this->reply->id,
			'author' => $this->reply->author,
		];
	}
}
