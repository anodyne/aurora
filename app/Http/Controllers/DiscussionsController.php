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

		$this->middleware('auth')->except(['index', 'show']);
	}

	public function index(Topic $topic = null, DiscussionFilters $filters)
	{
		// Get all the discussions sorted by the latest
		$discussions = Discussion::with([
			'replies.author',
		])->latest()->filter($filters);

		if ($topic->exists) {
			$discussions->where('topic_id', $topic->id);
		}

		if (request()->wantsJson()) {
			return $discussions->get();
		}

		return view('pages.discussions.all', [
			'discussions' => $discussions->paginate(20),
			'topics' => cache('topics', collect())->where('parent_id', null),
		]);
	}

	public function create()
	{
		$topics = Topic::get()->pluck('name', 'id');

		return view('pages.discussions.create', compact('topics'));
	}

	public function show($topic, Discussion $discussion)
	{
		//dd($discussion->answer());

		// Figure out if we need to load a parent topic
		$topic = ($discussion->topic->parent_id !== null)
			? $discussion->topic->load('parent')
			: $discussion->topic;

		// Get the replies and paginate them
		$replies = $discussion->replies()->paginate(20);

		return view('pages.discussions.show', compact('discussion', 'replies', 'topic'));
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

	public function destroy(Topic $topic, Discussion $discussion)
	{
		$this->authorize('update', $discussion);

		$discussion->delete();

		if (request()->wantsJson()) {
			return response([], 204);
		}

		flash()->success('Discussion deleted!');

		return redirect()->route('home');
	}
}
