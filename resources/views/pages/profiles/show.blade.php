@extends('layouts.app')

@section('title')
	User Profile - {{ $user->name }}
@endsection

@section('content')
	{!! avatar($user)->image()->label('Member since '.$user->present()->createdAtRelative)->large() !!}

	@foreach ($user->discussions as $discussion)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">{{ $discussion->title }}</h4>
			</div>

			<div class="panel-body">
				@markdown($discussion->body)
			</div>
		</div>
	@endforeach
@endsection