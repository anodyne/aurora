<div class="data-list">
@foreach ($discussions as $discussion)
	<div class="block">
		<div class="item">
			<div class="item-avatar">
				{!! avatar($discussion->author)->link() !!}
			</div>

			<div class="item-content">
				{!! $discussion->present()->titleAsLink !!}

				<div class="meta">
					<div class="meta-item topic">
						{!! $discussion->present()->topic !!}
					</div>

					@if ($discussion->replies_count > 0)
						<div class="meta-item replies">
							@icon('chat')
							<span>{{ $discussion->replies_count }} {{ str_plural('reply', $discussion->replies_count) }}</span>
						</div>
					@endif

					<div class="meta-item timestamp">
						@icon('clock')
						<span>
							{!! $discussion->present()->updatedAtRelative !!}
							by&nbsp;{!! $discussion->present()->updatedBy !!}
						</span>
					</div>

					@if ($discussion->answer)
						<div class="meta-item answered">
							@icon('check')
							<span>answered</span>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endforeach
</div>
