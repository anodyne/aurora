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
	}
	
	public function discussions(Topic $topic, DiscussionFilters $filters)
	{
		$discussions = Discussion::latest()->filter($filters);

		if ($topic->exists) {
			$discussions->where('topic_id', $topic->id);
		}

		$discussions = $discussions->get();

		return view('pages.discussions.index', compact('discussions'));
	}
}
