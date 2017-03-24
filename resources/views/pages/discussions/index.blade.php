@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
	        <div class="panel panel-default">
	            <div class="panel-heading">Forum Discussions</div>

	            <div class="panel-body">
	                @foreach ($discussions as $discussion)
						<article>
							<h4><a href="{{ route('discussions.show', [$discussion->topic->slug, $discussion]) }}">{{ $discussion->title }}</a></h4>
							<div class="body">{{ $discussion->body }}</div>
						</article>

						@if ( ! $loop->last)
							<hr>
						@endif
					@endforeach
	            </div>
	        </div>
	    </div>
	</div>
@endsection
