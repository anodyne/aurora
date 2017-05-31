<?php namespace App\Http\Controllers;

use App\Data\User;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
	public function __construct()
	{
		if (app()->environment() != 'testing') {
			auth()->setUser(\User::find(1));
			view()->share('_user', auth()->user());
		}
		
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
}
