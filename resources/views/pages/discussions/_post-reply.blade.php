<?php $panelClass = ($post->isAnswer) ? 'panel panel-success' : 'panel panel-default';?>
<div class="media">
	<div class="media-left">
		<span class="hidden-sm-down">{!! avatar($post->author)->link() !!}</span>
	</div>

	<div class="media-body">
		<div class="{{ $panelClass }}">
			<div class="panel-heading">
				<div class="hidden-sm-down">
					<h3 class="panel-title mr-auto"><a href="#">{{ $post->author->name }}</a></h3>
					<small class="timestamp text-subtle js-tooltip-top" title="{{ $post->present()->createdAt }}">Posted {{ $post->present()->createdAtRelative }}</small>
				</div>
				<div class="hidden-md-up d-flex align-items-center justify-content-start">
					{!! avatar($post->author)->link()->label($post->created_at->diffForHumans()) !!}
					<div class="dropdown ml-auto">
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
							<a class="dropdown-item" href="#">Message {{ $post->author->name }}</a>
							<a class="dropdown-item" href="#">Report</a>
						</div>
					</div>
				</div>
			</div>

			<div class="panel-body">
				<p>{{ $post->body }}</p>
			</div>

			@if (auth()->check())
				<div class="panel-footer hidden-sm-down d-flex justify-content-between align-items-center">
					<div class="btn-toolbar">
						<div class="btn-group">
							@if($post->isFavorited())
								<a href="#" class="btn btn-like js-tooltip-top d-flex align-items-center" title="Like this post">@icon('heart')<span class="pl-1">{{ $post->favorites_count }}</span></a>
							@else
								<div class="btn d-flex align-items-center">
									@icon('heart', 'liked')
									<span class="pl-1 text-subtle-darker">{{ $post->favorites_count }}</span>
								</div>
							@endif
						</div>
						<div class="btn-group">
							<a href="#" class="btn js-tooltip-top" title="Mark this post as the best answer">@icon('check')</a>
						</div>
						<div class="btn-group">
							<a href="#" class="btn js-tooltip-top" title="Edit the post">@icon('edit')</a>
						</div>
						<div class="btn-group">
							<a href="#" class="btn js-tooltip-top" title="Remove the post">@icon('trash')</a>
						</div>
					</div>

					<div class="btn-toolbar">
						<div class="btn-group">
							<a href="#" class="btn js-tooltip-top" title="Copy the link to this post">@icon('link')</a>
						</div>
						<div class="btn-group">
							<a href="#" class="btn js-tooltip-top" title="Send the author a message">@icon('paper-plane')</a>
						</div>
						<div class="btn-group">
							<a href="#" class="btn js-tooltip-top" title="Report this post">@icon('warning')</a>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
