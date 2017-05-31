<div class="media">
	<div class="media-left">
		<span class="hidden-sm-down">{!! avatar($post->author)->link() !!}</span>
	</div>

	<div class="media-body">
		<div class="panel panel-default">
			<div class="panel-heading hidden-sm-down">
				<h3 class="panel-title"><a href="{{ route('profile', [$post->author]) }}">{{ $post->author->name }}</a></h3>
				<small class="timestamp js-tooltip-top" title="{{ $post->present()->created }}">Started {{ $post->present()->created('relative') }}</small>
			</div>
			<div class="panel-heading hidden-md-up">
				{!! avatar($post->author)->link()->label($post->present()->created('relative')) !!}
				<div class="dropdown">
					<a href="#" id="dropdownMenuButton" data-toggle="dropdown">
						@icon('dots-three-vertical')
					</a>
					
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#">Edit</a>

						@can('update', $post)
							{!! Form::open(['route' => ['discussions.destroy', $post->topic, $post], 'method' => 'delete']) !!}
								{!! Form::button('Delete Discussion', ['type' => 'submit', 'class' => 'dropdown-item']) !!}
							{!! Form::close() !!}
						@endcan

						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Copy Link</a>
						<a class="dropdown-item" href="#">Message {{ $post->author->name }}</a>
						<a class="dropdown-item" href="#">Report</a>
					</div>
				</div>
			</div>

			<div class="panel-body">
				@markdown($post->body)

				@if ($post->author->signature)
					<div class="post-signature">
						@markdown($post->author->signature)
					</div>
				@endif
			</div>

			@if (auth()->check())
				<div class="panel-footer hidden-sm-down">
					<div>&nbsp;</div>
					<div class="dropdown dropup">
						<a href="#" id="dropdownMenuButton" class="btn" data-toggle="dropdown">
							@icon('icon-dots-three-vertical')
						</a>
						
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Edit</a>
							
							@can('update', $post)
								{!! Form::open(['route' => ['discussions.destroy', $post->topic, $post], 'method' => 'delete']) !!}
									{!! Form::button('Delete Discussion', ['type' => 'submit', 'class' => 'dropdown-item']) !!}
								{!! Form::close() !!}
							@endcan

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
