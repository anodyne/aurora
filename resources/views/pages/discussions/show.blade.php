@extends('layouts.app')

@section('content')
	<h1>{{ $discussion->title }}</h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Forum</a></li>
	
		@if ($topic->parent_id > 0)
			<li class="breadcrumb-item"><a href="{{ route('topics.discussions', [$topic->parent]) }}">{{ $topic->parent->name }}</a></li>
		@endif
		
		<li class="breadcrumb-item active"><a href="{{ route('topics.discussions', [$topic]) }}">{{ $topic->name }}</a></li>
	</ol>

	<div class="row">
		<div class="col-md-8">
			{!! view('pages.discussions._post')->with('post', $discussion) !!}

			@each('pages.discussions._post', $replies, 'post')

			{{ $replies->links() }}

			@if (auth()->check())
				<hr>

				<div class="media">
					<div class="media-left">{!! $_user->present()->avatar(['type' => 'image', 'class' => 'avatar sm']) !!}</div>
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
		</div>

		<div class="col-md-4">
			<div class="card">
				<div class="card-block">
					This discussion was published {{ $discussion->present()->createdDiff }} by {{ $discussion->present()->author }} and has {{ $discussion->replies_count }} {{ str_plural('reply', $discussion->replies_count) }}.
				</div>
			</div>
		</div>
	</div>
@endsection
