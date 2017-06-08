@component('pages.profiles.activities.activity')
	@slot('type', 'reply')
	
	@slot('icon')
		@icon('icon-reply')
	@endslot

	@slot('body')
		<p>Replied to the <a href="{{ route('discussions.show', [$activity->subject->discussion->topic, $activity->subject->discussion]) }}">{{ $activity->subject->discussion->title }}</a> discussion.</p>

		<a href="{{ route('discussions.show', [$activity->subject->discussion->topic, $activity->subject->discussion]) }}#reply-{{ $activity->subject->id }}" class="btn btn-outline-reply">View Reply</a>
	@endslot

	@slot('date')
		{{ $activity->subject->present()->created('time') }}
	@endslot
@endcomponent