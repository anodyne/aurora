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

					{{ dd($discussion, $discussion->isSubscribedTo) }}

					<subscribe-control :discussion="{{ $discussion }}"></subscribe-control>
				</div>
				
				<div class="meta">
					<div class="meta-item topic">
						{!! $discussion->present()->topic !!}
					</div>

					@if ($discussion->replies_count > 0)
						<div class="meta-item replies">
							@icon('icon-chat')
							<span>{{ $discussion->replies_count }} {{ str_plural('reply', $discussion->replies_count) }}</span>
						</div>
					@endif

					<div class="meta-item timestamp">
						@icon('icon-clock')
						<span>
							{!! $discussion->present()->updated('relative') !!}
							by&nbsp;{!! $discussion->present()->updatedBy !!}
						</span>
					</div>

					@if ($discussion->answer_count > 0)
						<div class="meta-item answered">
							@icon('icon-check')
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
