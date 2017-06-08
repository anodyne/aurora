<?php namespace App\Notifications;

use App\Data\Favorite;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ItemWasFavorited extends Notification
{
	use Queueable;

	protected $favorite;

	public function __construct(Favorite $favorite)
	{
		$this->favorite = $favorite;
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
		// Grab the favorite
		$favorite = $this->favorite;

		// Get the user who did the favorite-ing
		$favoriteAuthor = $favorite->author;

		// Grab the item that was favorited (a discussion or a reply)
		$favorited = $favorite->favorited;

		if ($favorite->favorited_type == 'App\Data\Reply') {
			$discussion = $favorited->discussion;
			$linkAppend = "#reply-{$favorited->id}";
			$linkText = 'See the reply';
			$message = "{$favoriteAuthor->name} liked your reply to <em>{$discussion->title}</em>";
		} else {
			$discussion = $favorited;
			$linkAppend = false;
			$linkText = 'See the discussion';
			$message = "{$favoriteAuthor->name} liked your discussion <em>{$discussion->title}</em>";
		}

		return [
			'message' => $message,
			'link' => route('discussions.show', [$discussion->topic, $discussion]).$linkAppend,
			'linkText' => $linkText,
			'author' => $favoriteAuthor,
		];
	}
}
