@extends('layouts.app')

@section('content')
	<h1>{{ $discussion->title }}</h1>

	<ul class="breadcrumb">
		<li><a href="{{ route('home') }}">Forum</a></li>

		<li class="active"><a href="{{ route('topics.discussions', [$discussion->topic]) }}">{{ $discussion->topic->name }}</a></li>
	</ul>

	{!! view('pages.discussions._post')->with('post', $discussion) !!}

	@each('pages.discussions._post', $discussion->replies, 'post')

	@if (auth()->check())
		<hr>

		<div class="media">
			<div class="media-left"><a href="#" class="avatar sm" style="background-image:url(http://placehold.it/100)"></a></div>
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
