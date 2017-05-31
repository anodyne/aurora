<?php namespace App\Http\Controllers;

use App\Data\Reply;
use App\Data\Favorite;
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
		$reply->favorite();

		return back();
	}

	public function destroy(Request $request, Reply $reply)
	{
		$reply->unfavorite();
	}
}
