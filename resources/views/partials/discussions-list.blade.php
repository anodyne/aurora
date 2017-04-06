<div class="data-list">
@foreach ($discussions as $discussion)
	<div class="d-flex align-items-start align-items-md-center justify-content-start mb-2 p-2">
		<div class="d-flex align-items-start align-items-md-center mr-auto">
			<div class="mr-3">
				<div class="hidden-sm-down">{!! $discussion->present()->authorAvatar !!}</div>
				<div class="hidden-md-up pt-2">{!! $discussion->present()->authorAvatar(true, 'xs') !!}</div>
			</div>
			<div>
				{!! $discussion->present()->titleAsLink !!}
				{!! $discussion->present()->topic !!}
				<span class="small text-muted pl-2">
					{!! $discussion->present()->updatedAt !!}
					{!! $discussion->present()->updatedBy !!}
				</span>
			</div>
		</div>
		<div class="text-center text-subtle font-mono mb-0 px-2 h4 font-weight-4">
			{{ $discussion->present()->replyCount }}
		</div>
	</div>
@endforeach
</div>
