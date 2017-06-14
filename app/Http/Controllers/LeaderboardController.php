<?php namespace App\Http\Controllers;

use App\Data\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
	public function index()
	{
		// Get all users who have more than 0 points
		$users = User::with('replies')
			->where('points', '>', 0)
			->orderBy('points', 'desc')
			->get();

		return view('pages.leaderboard', compact('users'));
	}
}
