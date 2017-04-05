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
		<div class="text-center pt-1">
			<div class="font-special mb-0">
				<span class="hidden-sm-down h3 font-weight-3">{{ $discussion->replies_count }}</span>
				<span class="hidden-md-up h4 font-weight-4 ">{{ $discussion->replies_count }}</span>
			</div>
			<small>{{ str_plural('reply', $discussion->replies_count) }}</small>
		</div>
	</div>
@endforeach
</div>
