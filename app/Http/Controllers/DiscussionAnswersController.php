<?php namespace App\Http\Controllers;

use App\Data\Discussion;
use Illuminate\Http\Request;

class DiscussionAnswersController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth');
	}

	public function store(Request $request, $topic, Discussion $discussion)
	{
		$this->authorize('answer', $discussion);
		
		$discussion->markAsBestAnswer($request->get('reply'));
	}

	public function destroy(Request $request, $topic, Discussion $discussion)
	{
		$discussion->unsubscribe();
	}
}
