@component('pages.profiles.activities.activity')
	@slot('type', 'favorite')

	@slot('icon')
		@icon('icon-thumbs-up')
	@endslot

	@slot('body')
		<p>Liked a reply by <a href="{{ route('profile', $activity->subject->favorited->author) }}">{{ $activity->subject->favorited->author->present()->name }}</a>.</p>

		<a href="{{ route('discussions.show', [$activity->subject->favorited->discussion->topic, $activity->subject->favorited->discussion]) }}#reply-{{ $activity->subject->favorited->id }}" class="btn btn-outline-favorite">View</a>
	@endslot

	@slot('date')
		{{ $activity->subject->present()->created('time') }}
	@endslot
@endcomponent