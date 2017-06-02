<?php namespace App\Http\Controllers;

use App\Data\Topic;
use App\Data\Discussion;
use Illuminate\Http\Request;
use App\Filters\DiscussionFilters;

class TopicsController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth');
	}

	public function index()
	{
		$this->authorize('manage', new Topic);

		$topics = Topic::with(['children' => function ($query) {
			$query->withTrashed();
		}])->parents()->withTrashed()->get();

		return view('pages.topics.index', compact('topics'));
	}

	public function create()
	{
		$this->authorize('create', new Topic);

		// Get only parent topics so we don't have infinite nesting
		$topics = Topic::parents()->get()->pluck('name', 'id');

		return view('pages.topics.create', compact('topics'));
	}

	public function store(Request $request)
	{
		$this->authorize('create', new Topic);

		$this->validate($request, [
			'name' => 'required',
		]);

		$topic = Topic::create($request->all());

		return redirect()->route('topics.index')
			->with('flash', 'Topic was created');
	}

	public function edit(Topic $topic)
	{
		$this->authorize('update', $topic);

		$topics = Topic::parents()->get()->pluck('name', 'id');

		return view('pages.topics.edit', compact('topic', 'topics'));
	}

	public function update(Request $request, Topic $topic)
	{
		$this->authorize('update', $topic);

		$this->validate($request, [
			'name' => 'required',
		]);

		$topic->update($request->all());

		return redirect()->route('topics.index')
			->with('flash', 'Topic was updated');
	}

	public function destroy(Request $request, Topic $topic)
	{
		$this->authorize('delete', $topic);

		// Grab the topic ID that discussions should be re-assigned to
		$newTopic = $request->get('newTopic');

		// Update all of the discussions
		$topic->discussions->each->update(['topic_id' => $newTopic]);

		// If the topic has children, move those children to the root
		if ($topic->children->count() > 0) {
			$topic->children->each->update(['parent_id' => null]);
		}

		$topic->delete();

		if ($request->expectsJson()) {
			return $topic;
		}

		return redirect()->route('topics.index')
			->with('flash', 'Topic was deleted');
	}

	public function restore(Request $request, Topic $topic)
	{
		$this->authorize('update', $topic);

		$topic->restore();

		if ($request->expectsJson()) {
			return response(['status' => 'Reply restored']);
		}

		return redirect()->route('topics.index')
			->with('flash', 'Topic was restored');
	}
}
