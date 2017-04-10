<?php namespace App\Http\Controllers;

use Reply;
use Favorite;
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
		// Create the favorite for the reply
		$reply->favorite();

		return back();
	}
}
