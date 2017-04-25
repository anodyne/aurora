@extends('layouts.app')

@section('title')
	User Profile - {{ $user->name }}
@endsection

@section('content')
	<div class="mb-4">
		{!! avatar($user)->image()->label('Member since '.$user->present()->createdAtRelative)->large() !!}
	</div>

	@foreach ($activities as $date => $activity)
		<h3>{{ $date }}</h3>
		
		@foreach ($activity as $record)
			@include ("pages.profiles.activities.{$record->type}", ['activity' => $record])
		@endforeach
	@endforeach
@endsection