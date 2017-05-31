@if ($paginator->hasPages())
	<div class="pagination">
		{{-- Previous Page Link --}}
		@if ($paginator->onFirstPage())
			<div class="page-item disabled"><span class="page-link">@icon('icon-chevron-left')</span></div>
		@else
			<div class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@icon('icon-chevron-left')</a></div>
		@endif

		{{-- Pagination Elements --}}
		@foreach ($elements as $element)
			{{-- "Three Dots" Separator --}}
			@if (is_string($element))
				<div class="page-item disabled"><span class="page-link">{{ $element }}</span></div>
			@endif

			{{-- Array Of Links --}}
			@if (is_array($element))
				@foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<div class="page-item active"><span class="page-link">{{ $page }}</span></div>
					@else
						<div class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></div>
					@endif
				@endforeach
			@endif
		@endforeach

		{{-- Next Page Link --}}
		@if ($paginator->hasMorePages())
			<div class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ svg_icon('chevron-right')->inline() }}</a></div>
		@else
			<div class="page-item disabled"><span class="page-link">{{ svg_icon('chevron-right')->inline() }}</span></div>
		@endif
	</div>
@endif
