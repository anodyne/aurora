<reply :attributes="{{ $reply }}" inline-template v-cloak>
	@php($replyIsAnswer = ($reply->id == $discussion->answer_id))
	@php($panelModifier = ($replyIsAnswer) ? 'panel-success' : 'panel-default')

	<div id="reply-{{ $reply->id }}" class="media">
		<div class="media-left">
			<span class="hidden-sm-down">{!! avatar($reply->author)->link() !!}</span>
		</div>

		<div class="media-body">
			<div class="panel {{ $panelModifier }}">
				<div class="panel-heading hidden-sm-down">
					<h3 class="panel-title mr-auto"><a href="{{ route('profile', $reply->author) }}">{{ $reply->author->name }}</a></h3>
					<small class="timestamp text-subtle js-tooltip-top" title="{{ $reply->present()->created }}">Replied {{ $reply->present()->created('relative') }}</small>
				</div>
				<div class="panel-heading hidden-md-up">
					{!! avatar($reply->author)->link()->label($reply->present()->created('relative')) !!}
					<div class="dropdown">
						<a href="#" id="dropdownMenuButton" data-toggle="dropdown">
							@icon('dots-three-vertical')
						</button>
						
						<div class="dropdown-menu dropdown-menu-right">
							@can('update', $reply)
								<a class="dropdown-item" href="#" @click.prevent="editing = true">Edit</a>
							@endcan

							@can('delete', $reply)
								<a class="dropdown-item" href="#" @click.prevent="destroy">Delete</a>
							@endcan
							
							@can('update', $reply)
								<div class="dropdown-divider"></div>
							@endcan
							<a class="dropdown-item" href="#">Mark as Answer</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Copy Link</a>
							<a class="dropdown-item" href="#">Message {{ $reply->author->name }}</a>
							<a class="dropdown-item" href="#">Report</a>
						</div>
					</div>
				</div>

				<div class="panel-body">
					<div v-if="editing">
						<div class="form-group">
							<textarea class="form-control" rows="10" v-model="body">{{ $reply->body }}</textarea>
						</div>

						<div class="btn-toolbar">
							<div class="btn-group">
								<button class="btn btn-primary" @click.prevent="update">Update</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-link-secondary" @click.prevent="editing = false">Cancel</button>
							</div>
						</div>
					</div>

					<div v-else>
						<div v-html="marked(body)"></div>

						@if ($reply->author->signature)
							<div class="post-signature">
								@markdown($reply->author->signature)
							</div>
						@endif
					</div>
				</div>

				@if (auth()->check())
					<div class="panel-footer hidden-sm-down">
						<div class="d-flex align-items-center justify-content-between">
							@if (auth()->check())
								<div>
									<favorite :reply="{{ $reply }}"></favorite>
								</div>
							@endif
							<a href="#" class="btn">@icon('check')</a>
						</div>

						<div class="dropdown dropup">
							<a href="#" id="dropdownMenuButton" class="btn" data-toggle="dropdown">
								@icon('dots-three-vertical')
							</a>
							
							<div class="dropdown-menu dropdown-menu-right">
								@can('update', $reply)
									<a class="dropdown-item" href="#" @click.prevent="editing = true">Edit</a>
								@endcan

								@can('delete', $reply)
									<a class="dropdown-item" href="#" @click.prevent="destroy">Delete</a>
								@endcan

								@can('update', $reply)
									<div class="dropdown-divider"></div>
								@endcan

								<a class="dropdown-item" href="#">Copy Link</a>
								<a class="dropdown-item" href="#">Message {{ $reply->author->name }}</a>
								<a class="dropdown-item" href="#">Report</a>
							</div>
						</div>
					</div>

					<div class="panel-footer hidden-md-up">
						@if (auth()->check())
							<favorite :reply="{{ $reply }}"></favorite>
						@endif
						<a href="#" class="btn">@icon('check')</a>
					</div>
				@endif
			</div>
		</div>
	</div>
</reply>