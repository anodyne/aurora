<?php namespace App\Http\Controllers;

use Reply;
use Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		if (app()->environment() != 'testing') {
			auth()->setUser(\User::find(1));
			view()->share('_user', auth()->user());
		}
		
		$this->middleware('auth');
	}

	public function store(Request $request, Reply $reply)
	{
		// Create the favorite for the reply
		$reply->favorite();

		return back();
	}
}
