<?php namespace App\Http\Controllers;

use App\Data\Reply;
use App\Data\Discussion;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('auth', ['except' => 'index']);
	}

	public function index($topic, Discussion $discussion)
	{
		return $discussion->replies()->paginate(20);
	}

	public function store(Request $request, $topic, Discussion $discussion)
	{
		$this->validate($request, ['body' => 'required']);
		
		$reply = $discussion->addReply([
			'body' => $request->get('body'),
			'user_id' => auth()->id()
		]);

		if ($request->expectsJson()) {
			return $reply->load('author');
		}

		return back()->with('flash', 'Your reply has been added.');
	}

	public function update(Request $request, Reply $reply)
	{
		$this->authorize('update', $reply);

		$reply->update($request->all());

		return back();
	}

	public function destroy(Request $request, Reply $reply)
	{
		$this->authorize('delete', $reply);
		
		$reply->delete();

		if ($request->expectsJson()) {
			return response(['status' => 'Reply deleted']);
		}

		return back();
	}
}
