<?php namespace App\Http\Controllers;

use User;
use Discussion;
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
		// Get all of the discussions started by the user
		$discussions = Discussion::user($user)->latest();

		return view('pages.profiles.show', [
			'discussions' => $discussions->paginate(20),
			'user' => $user,
		]);
	}
}
