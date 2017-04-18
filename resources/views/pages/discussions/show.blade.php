@extends('layouts.app')

@section('content')
	<h1>{{ $discussion->title }}</h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Forum</a></li>

		@if ($topic->parent_id)
			<li class="breadcrumb-item"><a href="{{ route('topics.discussions', [$topic->parent]) }}">{{ $topic->parent->name }}</a></li>
		@endif
		
		<li class="breadcrumb-item active"><a href="{{ route('topics.discussions', [$topic]) }}">{{ $topic->name }}</a></li>
	</ol>

	{!! view('pages.discussions._post-first')->with('post', $discussion) !!}

	<div class="discussion-summary">
		@icon('chat', 'text-subtle')

		<span>
			{{ $discussion->replies_count }} {{ str_plural('reply', $discussion->replies_count) }}

			@if ($discussion->isAnswered())
				with 1 correct answer
			@endif
		</span>
	</div>

	@if ($discussion->isAnswered())
		{!! view('pages.discussions._post-reply', ['reply' => $discussion->answer(), 'discussion' => $discussion]) !!}
	@endif

	@foreach ($replies as $reply)
		{!! view('pages.discussions._post-reply', compact('reply', 'discussion')) !!}
	@endforeach

	{{ $replies->links() }}

	<div class="discussion-summary">
		@icon('bell', 'text-subtle')
		<label>
			<input type="checkbox"> Notify me when there are replies to this discussion
		</label>
	</div>
@endsection

@push('scripts')
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/highlight.min.js"></script>
@endpush

@push('styles')
	<link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/solarized-dark.min.css" rel="stylesheet">
@endpush

@section('js')
	<script>
		hljs.initHighlightingOnLoad()
	</script>
@endsection