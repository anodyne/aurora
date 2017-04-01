<div class="data-list">
@foreach ($discussions as $discussion)
	<div class="row">
		<div class="col-10">
			<div class="list-item-avatar">
				<span class="hidden-sm-up">{!! $discussion->present()->authorAvatar(true, 'xs') !!}</span>
				<span class="hidden-xs-down">{!! $discussion->present()->authorAvatar !!}</span>
				@if ($discussion->answer)
					<span class="list-item-answered" title="Discussion has a reply marked as a correct answer">@icon('check')</span>
				@endif
			</div>

			<div class="list-item-group justify-content-between">
				{!! $discussion->present()->titleAsLink !!}

				{!! $discussion->present()->topic !!}
				<span class="list-item-meta">
					{!! $discussion->present()->updatedAt !!}
					{!! $discussion->present()->updatedBy !!}
				</span>
			</div>
		</div>
		<div class="col-2">
			{!! $discussion->present()->replyCount !!}
		</div>
	</div>
@endforeach
</div>
