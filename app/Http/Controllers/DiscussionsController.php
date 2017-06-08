<?php namespace App\Http\Controllers;

use Date;
use App\Data\Topic;
use App\Data\Discussion;
use Illuminate\Http\Request;
use App\Filters\DiscussionFilters;

class DiscussionsController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth')->except(['index', 'show']);
	}

	public function index(Topic $topic = null, DiscussionFilters $filters)
	{
		// Get all the discussions sorted by the latest
		$discussions = Discussion::with([
			'replies.author'
		])->orderBy('updated_at', 'desc')->filter($filters);

		if ($topic->exists) {
			$discussions->where('topic_id', $topic->id);
		}

		if (request()->wantsJson()) {
			return $discussions->get();
		}

		return view('pages.discussions.all', [
			'discussions' => $discussions->paginate(20),
			'topics' => cache('topics', collect())->where('parent_id', null)->sortBy('name'),
		]);
	}

	public function create()
	{
		return view('pages.discussions.create');
	}

	public function show($topic, Discussion $discussion)
	{
		// Record that the user visited the page
		if (auth()->check()) {
			auth()->user()->read($discussion);
		}

		// Figure out if we need to load a parent topic
		$topic = ($discussion->topic->parent_id !== null)
			? $discussion->topic->load('parent')
			: $discussion->topic;

		return view('pages.discussions.show', compact('discussion', 'topic'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
			'topic_id' => 'required|exists:forum_topics,id',
		]);

		$discussion = Discussion::create([
			'user_id' => auth()->id(),
			'topic_id' => $request->get('topic_id'),
			'title' => $request->get('title'),
			'body' => $request->get('body'),
		]);

		if (auth()->check()) {
			auth()->user()->read($discussion);
		}

		return redirect()->route('discussions.show', [$discussion->topic->slug, $discussion])
			->with('flash', 'Your discussion has been created.');
	}

	public function destroy(Topic $topic, Discussion $discussion)
	{
		$this->authorize('update', $discussion);

		$discussion->delete();

		if (request()->wantsJson()) {
			return response([], 204);
		}

		return redirect()->route('home')
			->with('flash', 'Your discussion has been deleted.');
	}
}
