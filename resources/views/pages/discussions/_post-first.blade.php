<div class="media">
	<div class="media-left">
		<span class="hidden-sm-down">{!! avatar($post->author)->link() !!}</span>
	</div>

	<div class="media-body">
		<div class="panel panel-default">
			<div class="panel-heading hidden-sm-down">
				<h3 class="panel-title"><a href="{{ route('profile', [$post->author]) }}">{{ $post->author->name }}</a></h3>
				<small class="timestamp js-tooltip-top" title="{{ $post->present()->createdAt }}">Posted {{ $post->present()->createdAtRelative }}</small>
			</div>
			<div class="panel-heading hidden-md-up">
				{!! avatar($post->author)->link()->label($post->created_at->diffForHumans()) !!}
				<div class="dropdown">
					<a href="#" id="dropdownMenuButton" data-toggle="dropdown">
						@icon('dots-three-vertical')
					</a>
					
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#">Edit</a>
						<a class="dropdown-item" href="#">Delete</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Copy Link</a>
						<a class="dropdown-item" href="#">Message {{ $post->author->name }}</a>
						<a class="dropdown-item" href="#">Report</a>
					</div>
				</div>
			</div>

			<div class="panel-body">
				@markdown($post->body)
			</div>

			@if (auth()->check())
				<div class="panel-footer hidden-sm-down">
					<div>&nbsp;</div>
					<div class="dropdown dropup">
						<a href="#" id="dropdownMenuButton" class="btn" data-toggle="dropdown">
							@icon('dots-three-vertical')
						</a>
						
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Edit</a>
							<a class="dropdown-item" href="#">Delete</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Copy Link</a>
							<a class="dropdown-item" href="#">Message {{ $post->author->name }}</a>
							<a class="dropdown-item" href="#">Report</a>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
