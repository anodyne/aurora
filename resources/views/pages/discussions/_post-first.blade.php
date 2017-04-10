<div class="media">
	<div class="media-left">
		<span class="hidden-sm-down">{!! avatar($post->author)->link() !!}</span>
	</div>

	<div class="media-body">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><a href="#">{{ $post->author->name }}</a></h3>
				<small class="timestamp font-subtle js-tooltip-top" title="{{ $post->present()->createdAt }}">Posted {{ $post->present()->createdAtRelative }}</small>
				<span class="hidden-md-up">{!! avatar($post->author)->link()->label($post->created_at->diffForHumans()) !!}</span>
			</div>

			<div class="panel-body">
				<p>{{ $post->body }}</p>
			</div>

			@if (auth()->check())
				<div class="panel-footer d-flex justify-content-between align-items-center">
					<div class="btn-toolbar">
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
