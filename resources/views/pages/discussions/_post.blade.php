<div class="media">
	<div class="media-left">
		{!! avatar($post->author)->link() !!}
	</div>

	<div class="media-body">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="pull-right timestamp">Posted {{ $post->created_at->diffForHumans() }}</div>
					<a href="#">{{ $post->author->name }}</a>
				</h3>
			</div>

			<div class="panel-body">
				<p>{{ $post->body }}</p>
			</div>

			@if (auth()->check())
				<div class="panel-footer">
					<div class="btn-toolbar pull-right">
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

					<div class="btn-toolbar">
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
				</div>
			@endif
		</div>
	</div>
</div>
