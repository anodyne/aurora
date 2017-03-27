<?php namespace App\Http\Controllers;

use Topic;
use Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['index', 'show']);
	}

	public function index($topic = null)
	{
		if ($topic) {
			$topic = Topic::where('slug', $topic)->first()->id;
			$discussions = Discussion::where('topic_id', $topic)->latest()->get();
		} else {
			$discussions = Discussion::with('topic')->latest()->get();
		}

		return view('pages.discussions.index', compact('discussions'));
	}

	public function create()
	{
		return view('pages.discussions.create');
	}

	public function show($topic, Discussion $discussion)
	{
		$discussion->load(['author', 'replies.author', 'topic']);

		return view('pages.discussions.show', compact('topic', 'discussion'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
			'topic_id' => 'required|exists:topics,id',
		]);

		$discussion = Discussion::create([
			'user_id' => auth()->id(),
			'topic_id' => $request->get('topic_id'),
			'title' => $request->get('title'),
			'body' => $request->get('body'),
		]);

		return redirect()->route('discussions.show', [$discussion->topic->slug, $discussion]);
	}
}
