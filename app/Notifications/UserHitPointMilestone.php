<?php namespace App\Notifications;

use App\Data\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserHitPointMilestone extends Notification
{
	use Queueable;

	protected $user;
	protected $milestone;
	protected $points;

	public function __construct(User $user, $milestone, $points)
	{
		$this->user = $user;
		$this->milestone = number_format($milestone);
		$this->points = number_format($points);
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
			'message' => "Congrats! You've passed {$this->milestone} experience points and currently have {$this->points} XP. Thanks for your contributions to the community.",
			'link' => route('profile', [$this->user]),
			'author' => $this->user,
		];
	}

	protected function setMilestoneMessage()
	{
		$messages = [
			100 => "Congrats! You've passed 100 experience points and currently have {$this->points} XP. Thanks for your contributions to the community!",
			250 => "You're moving now! By passing 250 experience points, you've actively contributed to making the Anodyne community a welcoming and helpful place. Thank you!",
			500 => "Next stop, 1,000 points! With over 500 XP, you're one of the most active members of the community. Thank you!",
			1000 => "",
			2500 => "",
			5000 => "",
			10000 => "",
			25000 => "",
			50000 => "",
			100000 => "",
		];

		return $message[$this->milestone];
	}
}
