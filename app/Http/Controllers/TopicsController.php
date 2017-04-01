<?php namespace App\Http\Controllers;

use Topic;
use Discussion;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
		if ($topic->exists) {
			$discussions = $topic->discussions()->latest()->get();
		} else {
			$discussions = Discussion::latest()->get();
		}

		return view('pages.discussions.index', compact('discussions'));
	}
}
