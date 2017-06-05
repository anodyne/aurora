<?php namespace App\Notifications;

use App\Data\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AnnouncementWasCreated extends Notification
{
	use Queueable;

	protected $announcement;

	public function __construct(Announcement $announcement)
	{
		$this->announcement = $announcement;
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
			'message' => $this->announcement->body,
			'announcement_id' => $this->announcement->id,
			'author' => $this->announcement->author,
		];
	}
}
