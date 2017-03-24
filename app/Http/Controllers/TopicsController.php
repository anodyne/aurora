<?php namespace App\Http\Controllers;

use Topic, Discussion;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
	public function discussions(Topic $topic)
	{
		if ($topic->exists) {
			$discussions = $topic->discussions()->latest()->get();
		} else {
			$discussions = Discussion::latest()->get();
		}

		return view('pages.discussions.index', compact('discussions'));
	}
}
