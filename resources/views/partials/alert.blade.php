<div class="alert alert-{{ $level }}" role="alert">
	@if ($header)
		<h4 class="alert-heading">{{ $header }}</h4>
	@endif

	@if ($icon)
		<div class="d-flex align-items-center">
			@icon($icon, 'mr-3 md')
			<p>{!! $message !!}</p>
		</div>
	@else
		<p>{!! $message !!}</p>
	@endif
</div>