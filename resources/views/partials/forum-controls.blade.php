<div class="forum-controls">
	<div class="hidden-sm-down">
		@if (auth()->check())
			<p><a href="{{ route('discussions.create') }}" class="btn btn-primary btn-lg btn-block">Start a Discussion</a></p>
		@endif

		<h6>Choose a Filter</h6>

		<div class="list-group">
			<a href="{{ route('home') }}" class="list-group-item">@icon('list') All Discussions</a>
			
			@if (auth()->check())
				<a href="#" class="list-group-item disabled">@icon('new') Unread Discussions</a>
				<a href="{{ route('home') }}?by={{ $_user->name }}" class="list-group-item">@icon('user') My Discussions</a>
				<a href="#" class="list-group-item disabled">@icon('heart') My Favorites</a>
			@endif

			<a href="#" class="list-group-item disabled">@icon('flash') Popular This Week</a>
			<a href="{{ route('home') }}?popular=1" class="list-group-item">@icon('rocket') Popular All Time</a>
			<a href="#" class="list-group-item disabled">@icon('help-with-circle') Unanswered Questions</a>
			<a href="#" class="list-group-item disabled">@icon('check') Answered Questions</a>
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

	<div class="hidden-md-up">
		@if (auth()->check())
			<div class="row">
				<div class="col">
					<p><a href="{{ route('discussions.create') }}" class="btn btn-primary btn-block">Start a Discussion</a></p>
				</div>
				<div class="col-3">
					<p><a href="#" class="btn btn-outline-secondary btn-block">@icon('funnel')</a></p>
				</div>
			</div>
		@endif

		<div class="hidden-sm-down">
			<h6>Choose a Filter</h6>

			<div class="list-group">
				<a href="{{ route('home') }}" class="list-group-item">@icon('list') All Discussions</a>
				
				@if (auth()->check())
					<a href="#" class="list-group-item disabled">@icon('new') Unread Discussions</a>
					<a href="{{ route('home') }}?by={{ $_user->name }}" class="list-group-item">@icon('user') My Discussions</a>
					<a href="#" class="list-group-item disabled">@icon('heart') My Favorites</a>
				@endif

				<a href="#" class="list-group-item disabled">@icon('flash') Popular This Week</a>
				<a href="{{ route('home') }}?popular=1" class="list-group-item">@icon('rocket') Popular All Time</a>
				<a href="#" class="list-group-item disabled">@icon('help-with-circle') Unanswered Questions</a>
				<a href="#" class="list-group-item disabled">@icon('check') Answered Questions</a>
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
	</div>
</div>
