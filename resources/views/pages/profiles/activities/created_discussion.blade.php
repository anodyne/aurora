@component('pages.profiles.activities.activity')
	@slot('body')
		@icon('new-message', 'lg text-subtle mr-3')
		<div>Created the <a href="{{ route('discussions.show', [$activity->subject->topic, $activity->subject]) }}">{{ $activity->subject->title }}</a> discussion.</div>
	@endslot
@endcomponent