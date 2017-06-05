<?php namespace App\Http\Controllers;

use App\Data\Announcement;
use Illuminate\Http\Request;
use App\Filters\DiscussionFilters;

class AnnouncementsController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth');
	}

	public function index()
	{
		$this->authorize('manage', new Announcement);

		$announcements = Announcement::latest()->get();

		return view('pages.announcements.index', compact('announcements'));
	}

	public function create()
	{
		$this->authorize('create', new Announcement);

		return view('pages.announcements.create');
	}

	public function store(Request $request)
	{
		$this->authorize('create', new Announcement);

		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
		]);

		$announcement = Announcement::create($request->all());

		return redirect()->route('announcements.index')
			->with('flash', 'Announcement was created');
	}

	public function edit(Announcement $announcement)
	{
		$this->authorize('update', $announcement);

		return view('pages.announcements.edit', compact('announcement'));
	}

	public function update(Request $request, Announcement $announcement)
	{
		$this->authorize('update', $announcement);

		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
		]);

		$announcement->update($request->all());

		return redirect()->route('announcements.index')
			->with('flash', 'Announcement was updated');
	}

	public function destroy(Request $request, Announcement $announcement)
	{
		$this->authorize('delete', $announcement);

		$announcement->delete();

		if ($request->expectsJson()) {
			return $announcement;
		}

		return redirect()->route('announcements.index')
			->with('flash', 'Announcement was deleted');
	}
}
