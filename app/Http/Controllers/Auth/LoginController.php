<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	use AuthenticatesUsers;

	public function __construct()
	{
		parent::__construct();
	}

	protected function authenticated(Request $request, $user)
	{
		//session()->flash('flash', "Welcome back, {$user->present()->name}!");
	}

	/*public function logout()
	{
		session()->flash('flash', "See you next time!");

		parent::logout(request());
	}*/

	public function redirectTo()
	{
		return route('home');
	}
}
