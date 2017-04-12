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

	<div>
		<div class="discussion-summary d-inline-flex align-items-center">
			@icon('chat', 'text-subtle')

			<span class="pl-2">
				{{ $discussion->replies_count }} {{ Str::plural('reply', $discussion->replies_count) }}

				@if ($discussion->answer)
					with 1 correct answer
				@endif
			</span>
		</div>
	</div>

	@if ($discussion->answer)
		{!! view('pages.discussions._post-reply')->with('post', $discussion->answer) !!}
	@endif

	@each('pages.discussions._post-reply', $replies, 'post')

	{{ $replies->links() }}

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
