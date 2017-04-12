<?php namespace App\Http\Controllers;

use Topic;
use Discussion;
use Illuminate\Http\Request;
use App\Filters\DiscussionFilters;

class TopicsController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (app()->environment() != 'testing') {
			auth()->setUser(\User::find(1));
			view()->share('_user', auth()->user());
		}
	}
}
