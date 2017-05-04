@component('pages.profiles.activities.activity')
	@slot('type', 'discussion')

	@slot('icon')
		@icon('new-message')
	@endslot

	@slot('body')
		<p>Started the <a href="{{ route('discussions.show', [$activity->subject->topic, $activity->subject]) }}">{{ $activity->subject->title }}</a> discussion.</p>

		<a href="{{ route('discussions.show', [$activity->subject->topic, $activity->subject]) }}" class="btn btn-outline-discussion">View Discussion</a>
	@endslot

	@slot('date')
		{{ $activity->subject->present()->created('time') }}
	@endslot
@endcomponent