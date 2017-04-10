<div class="d-flex align-items-center">
@if ($type == 'link')
	<a href="{{ $link }}" class="avatar {{ $size }}" style="background-image:url({{ $url }})"></a>
@else
	<div class="avatar {{ $size }}" style="background-image:url({{ $url }})"></div>
@endif

@if ($label)
	<div class="d-flex flex-column ml-3">
		@if ($size == 'lg')
			<span class="h1">{{ $user->name }}</span>
			<span class="text-muted">1,650 XP</span>
		@elseif ($size == 'md')
			<span class="h4">{{ $user->name }}</span>
			<span class="text-muted">7,990 XP</span>
		@elseif ($size == 'sm')
			<span class="h5 mb-0">{{ $user->name }}</span>
		@elseif ($size == 'xs')
			<span class="h6 mb-0">{{ $user->name }}</span>
		@else
			<span class="h6 mb-1">{{ $user->name }}</span>
			<small class="text-muted">
				@if ($labelContentBefore !== null)
					{!! $labelContentBefore !!} &nbsp; &bull; &nbsp;
				@endif

				450 XP

				@if ($labelContentAfter !== null)
					&nbsp; &bull; &nbsp; {!! $labelContentAfter !!}
				@endif
			</small>
		@endif
	</div>
@endif
</div>