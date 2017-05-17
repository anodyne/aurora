@extends('layouts.app')

@section('title')
	User Profile - {{ $user->name }}
@endsection

@section('content')
	<div class="mb-4">
		{!! avatar($user)->image()->label('Member since '.$user->present()->created('relative'))->large() !!}
	</div>

	@forelse ($activities as $date => $activity)
		<div class="text-center">
			<span class="cd-date-heading">{{ $date }}</span>
		</div>

		<section class="cd-timeline cd-container">
			@foreach ($activity as $record)
				@include ("pages.profiles.activities.{$record->type}", ['activity' => $record])
			@endforeach
		</section>
	@empty
		{!! alert('warning', "No activity found.") !!}
	@endforelse
@endsection