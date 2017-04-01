<?php namespace App\Http\Controllers;

use Discussion;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('auth');
	}

	public function store(Request $request, $topic, Discussion $discussion)
	{
		$this->validate($request, ['body' => 'required']);
		
		$discussion->addReply([
			'body' => $request->get('body'),
			'user_id' => auth()->id()
		]);

		return back();
	}
}
