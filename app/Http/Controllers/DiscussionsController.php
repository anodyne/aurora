<?php namespace App\Http\Controllers;

use Topic;
use Discussion;
use Illuminate\Http\Request;
use App\Filters\DiscussionFilters;

class DiscussionsController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (app()->environment() != 'testing') {
			auth()->setUser(\User::find(1));
			view()->share('_user', auth()->user());
		}

		$this->middleware('auth')->except(['all', 'index', 'show']);
	}

	public function index(DiscussionFilters $filters)
	{
		// Get all the parent topics for the sidebar
		$topics = Topic::with('children')->where('parent_id', null)->get();

		// Get all the discussions sorted by the latest
		$discussions = Discussion::with([
			'replies',
			'replies.author',
			'topic',
			'topic.parent',
			'author'
		])->latest()->filter($filters)->get();

		if (request()->wantsJson()) {
			return $discussions;
		}

		return view('pages.discussions.all', compact('discussions', 'topics'));
	}

	public function create()
	{
		$topics = Topic::get()->pluck('name', 'id');

		return view('pages.discussions.create', compact('topics'));
	}

	public function show(Topic $topic, Discussion $discussion)
	{
		$discussion->load(['author', 'replies.author', 'topic']);

		return view('pages.discussions.show', [
			'discussion' => $discussion,
			'replies' => $discussion->replies()->paginate(1),
			'topic' => $topic
		]);
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
