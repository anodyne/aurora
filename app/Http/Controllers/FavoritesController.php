<?php namespace App\Http\Controllers;

use App\Data\Reply;
use App\Data\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
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
