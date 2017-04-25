@component('pages.profiles.activities.activity')
	@slot('body')
		@icon('reply', 'lg text-subtle mr-3')
		<div>Replied to the <a href="{{ route('discussions.show', [$activity->subject->discussion->topic, $activity->subject->discussion]) }}">{{ $activity->subject->discussion->title }}</a> discussion.</div>
	@endslot
@endcomponent