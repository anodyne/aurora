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
		
		if (app()->environment() != 'testing') {
			auth()->setUser(\User::find(1));
			view()->share('_user', auth()->user());
		}

		$this->middleware('auth');
	}

	public function index()
	{
		$this->authorize('manage', new Topic);

		$topics = Topic::with('children')->parents()->withTrashed()->get();

		return view('pages.topics.index', compact('topics'));
	}

	public function create()
	{
		$this->authorize('create', new Topic);

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
			->with('flash', 'Topic added.');
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
			->with('flash', 'Topic updated.');
	}

	public function remove(Topic $topic)
	{
		$topics = Topic::where('id', '!=', $topic->id)->get()->pluck('name', 'id');

		if (policy($topic)->remove(auth()->user())) {
			$body = ($topic)
				? view('pages.topics._remove', compact('topic', 'topics'))
				: alert('danger', "Topic not found.");
		} else {
			$body = alert('danger', 'You do not have permission to remove topics.');
		}

		return partial('modal-content', [
			'header' => "Remove Topic",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function destroy(Request $request, Topic $topic)
	{
		$this->authorize('delete', $topic);

		// Reassign discussions that are in this topic

		$topic->delete();

		return redirect()->route('topics.index')
			->with('flash', 'Topic deleted.');
	}

	public function restore(Request $request, Topic $topic)
	{
		$this->authorize('update', $topic);

		$topic->restore();

		if ($request->expectsJson()) {
			return response(['status' => 'Reply deleted']);
		}

		return redirect()->route('topics.index')
			->with('flash', 'Topic restored.');
	}
}
