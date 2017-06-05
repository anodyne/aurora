<?php namespace App\Http\Controllers;

use App\Data\User;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('auth');
	}

	public function index(User $user)
	{
		return auth()->user()->unreadNotifications;
	}

	public function destroy(User $user, $notificationId)
	{
		auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
	}

	public function destroyAll(Request $request, User $user)
	{
		// Get the IDs we want to mark as read
		$marked = $request->get('notifications');
		//dd($marked, auth()->user()->notifications()->whereIn('id', $marked)->get());

		auth()->user()->notifications()->whereIn('id', $marked)->get()->each->markAsRead();
	}
}
