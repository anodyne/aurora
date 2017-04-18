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

	@if (auth()->check())
		<hr>

		<div class="media">
			<div class="media-left">
				<span class="hidden-sm-down">{!! avatar($_user)->image() !!}</span>
			</div>
			<div class="media-body">
				{!! Form::open(['route' => ['discussions.replies', $topic, $discussion]]) !!}
					<div class="form-group">
						{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Reply to this discussion now...']) !!}
					</div>
					<div class="form-group">
						{!! Form::button('Reply', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	@endif
@endsection

@push('scripts')
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
@endpush

@section('js')
	<script>
		$('pre').addClass('prettyprint')
	</script>
@endsection

@push('styles')
	<link href="{{ asset('css/prettyprint-github-v2.css') }}" rel="stylesheet">
@endpush