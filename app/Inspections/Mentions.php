<?php namespace App\Inspections;

use App\Data\User;
use App\Events\UserWasMentioned;

class Mentions implements Inspectable
{
	public function inspect($text, $model = null)
	{
		if (preg_match_all('/(^|\s)@(\w*[a-zA-Z_-]+\w*)/', strip_tags($text), $matches)) {
			if (count($matches[2]) > 0) {
				collect($matches[2])->each(function ($match) use ($model) {
					// Find the user by their username
					$user = User::username($match)->first();

					if ($user) {
						// Fire the event to notify them
						event(new UserWasMentioned($user, $model));
					}
				});
			}
		}
	}
}
