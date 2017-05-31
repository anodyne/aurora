<div class="forum-controls">
	<div class="hidden-sm-down">
		@if (auth()->check())
			<p><a href="{{ route('discussions.create') }}" class="btn btn-primary btn-lg btn-block">Start a Discussion</a></p>
		@endif

		<h6>Choose a Filter</h6>

		<div class="list-group">
			<a href="{{ route('home') }}" class="list-group-item">@icon('icon-list') All Discussions</a>
			
			@if (auth()->check())
				<a href="#" class="list-group-item disabled">@icon('icon-new') Unread Discussions</a>
				<a href="{{ request()->url() }}?by={{ $_user->username }}" class="list-group-item">@icon('icon-user') My Discussions</a>
				<a href="#" class="list-group-item disabled">@icon('icon-heart') My Favorites</a>
				<a href="{{ request()->url() }}?subscribed=1" class="list-group-item">@icon('icon-star') Subscribed</a>
			@endif

			<a href="{{ request()->url() }}?trending=1" class="list-group-item">@icon('icon-flash') Popular This Week</a>
			<a href="{{ request()->url() }}?popular=1" class="list-group-item">@icon('icon-rocket') Popular All Time</a>
			<a href="{{ request()->url() }}?answered=1" class="list-group-item">@icon('icon-check') Answered</a>
		</div>

		<h6>Or Pick a Topic</h6>

		<div class="list-group">
			<a href="{{ route('home') }}" class="list-group-item justify-content-between">
				All
				<span class="badge badge-pill" style="background-color:#333">&nbsp;</span>
			</a>

			@foreach ($topics as $topic)
				<a href="{{ route('topics.discussions', [$topic]) }}" class="list-group-item justify-content-between">
					{{ $topic->name }}
					<span class="badge badge-pill" style="background-color:{{ $topic->color }}">&nbsp;</span>
				</a>

				@if ($topic->children->count() > 0)
					@foreach ($topic->children as $child)
						<a href="{{ route('topics.discussions', [$child]) }}" class="list-group-item justify-content-between">
							<div>
								{{ $child->name }}
								<br><em class="text-muted">{{ $topic->name }}</em>
							</div>
							<span class="badge badge-pill" style="background-color:{{ $child->color }}">&nbsp;</span>
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
					<p><a href="{{ route('discussions.create') }}" class="btn btn-primary btn-lg btn-block">
						<span class="hidden-sm-up">@icon('icon-new-message')</span>
						<span class="hidden-xs-down">Start Discussion</span>
					</a></p>
				</div>
				<div class="col">
					<p><a href="#" data-toggle="modal" data-target="#discussionFiltersMobile" class="btn btn-outline-secondary btn-lg btn-block">
						<span class="hidden-sm-up">@icon('icon-funnel')</span>
						<span class="hidden-xs-down">Filter</span>
					</a></p>
				</div>
			</div>
		@endif
	</div>
</div>

<div class="modal fade" id="discussionFiltersMobile">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filter Discussions</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body forum-controls">
				<h6>Choose a Filter</h6>

				<div class="list-group">
					<a href="{{ route('home') }}" class="list-group-item">@icon('icon-list') All Discussions</a>
					
					@if (auth()->check())
						<a href="#" class="list-group-item disabled">@icon('icon-new') Unread Discussions</a>
						<a href="{{ request()->url() }}?by={{ $_user->username }}" class="list-group-item">@icon('icon-user') My Discussions</a>
						<a href="#" class="list-group-item disabled">@icon('icon-heart') My Favorites</a>
						<a href="{{ request()->url() }}?subscribed=1" class="list-group-item">@icon('icon-star') Subscribed</a>
					@endif

					<a href="{{ request()->url() }}?trending=1" class="list-group-item">@icon('icon-flash') Popular This Week</a>
					<a href="{{ request()->url() }}?popular=1" class="list-group-item">@icon('icon-rocket') Popular All Time</a>
					<a href="{{ request()->url() }}?answered=1" class="list-group-item">@icon('icon-check') Answered Questions</a>
				</div>

				<h6>Or Pick a Topic</h6>

				<div class="list-group">
					<a href="{{ route('home') }}" class="list-group-item justify-content-between">
						All
						<span class="badge badge-pill" style="background-color:#333">&nbsp;</span>
					</a>

					@foreach ($topics as $topic)
						<a href="{{ route('topics.discussions', [$topic]) }}" class="list-group-item justify-content-between">
							{{ $topic->name }}
							<span class="badge badge-pill" style="background-color:{{ $topic->color }}">&nbsp;</span>
						</a>

						@if ($topic->children->count() > 0)
							@foreach ($topic->children as $child)
								<a href="{{ route('topics.discussions', [$child]) }}" class="list-group-item justify-content-between">
									<div>
										{{ $child->name }}
										<br><em class="text-muted">{{ $topic->name }}</em>
									</div>
									<span class="badge badge-pill" style="background-color:{{ $child->color }}">&nbsp;</span>
								</a>
							@endforeach
						@endif
					@endforeach
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn btn-lg btn-block btn-default">Close</a>
			</div>
		</div>
	</div>
</div>
