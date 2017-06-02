<?php namespace App\Http\Controllers;

use App\Data\User;
use App\Data\Activity;
use App\Data\Discussion;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	public function __construct()
	{
		parent::__construct();
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
