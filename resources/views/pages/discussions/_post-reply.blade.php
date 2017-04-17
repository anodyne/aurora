@php($replyIsAnswer = ($reply->id == $discussion->answer_id))
@php($panelModifier = ($replyIsAnswer) ? 'panel-success' : 'panel-default')

<div class="media">
	<div class="media-left">
		<span class="hidden-sm-down">{!! avatar($reply->author)->link() !!}</span>
	</div>

	<div class="media-body">
		<div class="panel {{ $panelModifier }}">
			<div class="panel-heading hidden-sm-down">
				<h3 class="panel-title mr-auto"><a href="#">{{ $reply->author->name }}</a></h3>
				<small class="timestamp text-subtle js-tooltip-top" title="{{ $reply->present()->createdAt }}">Posted {{ $reply->present()->createdAtRelative }}</small>
			</div>
			<div class="panel-heading hidden-md-up">
				{!! avatar($reply->author)->link()->label($reply->created_at->diffForHumans()) !!}
				<div class="dropdown">
					<a href="#" id="dropdownMenuButton" data-toggle="dropdown">
						@icon('dots-three-vertical')
					</button>
					
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#">Edit</a>
						<a class="dropdown-item" href="#">Delete</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Mark as Answer</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Copy Link</a>
						<a class="dropdown-item" href="#">Message {{ $reply->author->name }}</a>
						<a class="dropdown-item" href="#">Report</a>
					</div>
				</div>
			</div>

			<div class="panel-body">
				@if ($replyIsAnswer)
					<span class="hidden-lg-up">{!! alert('success', 'Marked as the best answer', null, 'check') !!}</span>
				@endif

				<!--?prettify?-->

				@markdown($reply->body)
			</div>

			@if (auth()->check())
				<div class="panel-footer hidden-sm-down">
					<div class="d-flex align-items-center justify-content-between">
						<a href="#" class="btn d-flex align-items-center">@icon('thumbs-up')<span class="pl-1">{{ $reply->favorites_count }}</span></a>
						<a href="#" class="btn">@icon('check')</a>
					</div>

					<div class="dropdown dropup">
						<a href="#" id="dropdownMenuButton" class="btn" data-toggle="dropdown">
							@icon('dots-three-vertical')
						</a>
						
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Edit</a>
							<a class="dropdown-item" href="#">Delete</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Copy Link</a>
							<a class="dropdown-item" href="#">Message {{ $reply->author->name }}</a>
							<a class="dropdown-item" href="#">Report</a>
						</div>
					</div>
				</div>

				<div class="panel-footer hidden-md-up">
					<a href="#" class="btn">@icon('heart')<span class="pl-1">{{ $reply->favorites_count }}</span></a>
					<a href="#" class="btn">@icon('check')</a>
				</div>
			@endif
		</div>
	</div>
</div>
