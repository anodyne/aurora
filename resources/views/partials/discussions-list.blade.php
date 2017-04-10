<div class="data-list">
@foreach ($discussions as $discussion)
	<div class="d-flex align-items-start align-items-md-center justify-content-start mb-2 p-2">
		<div class="d-flex align-items-start align-items-md-center mr-auto">
			<div class="mr-3">
				<div class="hidden-sm-down">{!! avatar($discussion->author)->link() !!}</div>
				<div class="hidden-md-up pt-2">{!! avatar($discussion->author)->link()->small() !!}</div>
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
		<div class="text-center text-subtle font-special mb-0 px-2 h5 font-weight-3">
			{{ $discussion->present()->replyCount }}
		</div>
	</div>
@endforeach
</div>
