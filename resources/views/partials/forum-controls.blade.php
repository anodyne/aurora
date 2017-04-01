<div class="forum-controls">
	@if ($_user)
		<p><a href="{{ route('discussions.create') }}" class="btn btn-primary btn-lg btn-block">Start a Discussion</a></p>
	@endif

	<h6>Choose a Filter</h6>

	<div class="list-group">
		@if (auth()->check())
			<a href="{{ route('home') }}?by={{ $_user->name }}" class="list-group-item">My Discussions</a>
			<a href="#" class="list-group-item disabled">My Favorites</a>
		@endif

		<a href="#" class="list-group-item disabled">Popular This Week</a>
		<a href="#" class="list-group-item disabled">Popular All Time</a>
		<a href="#" class="list-group-item disabled">Answered Questions</a>
	</div>

	<h6>Or Pick a Topic</h6>

	<div class="list-group">
		<a href="#" class="list-group-item">All</a>
		@foreach ($topics as $topic)
			<a href="{{ route('topics.discussions', [$topic]) }}" class="list-group-item justify-content-between">
				{{ $topic->name }}
				<span class="badge badge-pill" style="background-color:{{ $topic->color }}">&nbsp;</span>
			</a>

			@if ($topic->children->count() > 0)
				@foreach ($topic->children as $child)
					<a href="{{ route('topics.discussions', [$child]) }}" class="list-group-item justify-content-between">
						<span class="badge badge-pill" style="background-color:{{ $child->color }}">&nbsp;</span>
						{{ $child->name }}
						<br><em class="text-muted">{{ $child->parent->name }}</em>
					</a>
				@endforeach
			@endif
		@endforeach
	</div>
</div>
