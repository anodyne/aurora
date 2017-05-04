<?php namespace App\Http\Controllers;

use User;
use Discussion;
use App\Data\Activity;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (app()->environment() != 'testing') {
			auth()->setUser(\User::find(1));
			view()->share('_user', auth()->user());
		}
	}

	public function show(User $user)
	{
		// Get all of the user's activity
		$activities = Activity::with('subject')
			->user($user)
			->latest()
			->get()
			->groupBy(function ($activity) {
				return $activity->created_at->format('d M Y');
			});

		return view('pages.profiles.show', [
			'activities' => $activities,
			'user' => $user,
		]);
	}
}
