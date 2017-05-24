<div class="data-list">
@forelse ($discussions as $discussion)
	<div class="block">
		<div class="item">
			<div class="item-avatar">
				{!! avatar($discussion->author)->link() !!}
			</div>

			<div class="item-content">
				<div class="d-flex align-items-center mb-1">
					{!! $discussion->present()->titleAsLink !!}
				
					@if ($discussion->isSubscribedTo)
						@icon('star', 'text-primary mb-1 ml-1')
					@endif
				</div>
				
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
							{!! $discussion->present()->updated('relative') !!}
							by&nbsp;{!! $discussion->present()->updatedBy !!}
						</span>
					</div>

					@if ($discussion->answer_count > 0)
						<div class="meta-item answered">
							@icon('check')
							<span>answered</span>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@empty
	{!! alert('warning', 'No discussions found.') !!}
@endforelse
</div>
