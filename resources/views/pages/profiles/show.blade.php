@extends('layouts.app')

@section('title')
	User Profile - {{ $user->name }}
@endsection

@section('content')
	{!! avatar($user)->image()->label('Member since '.$user->present()->createdAtRelative)->large() !!}

	@if ($discussions->total() > 0)
		{!! partial('discussions-list', ['discussions' => $discussions]) !!}

		{{ $discussions->appends(request()->all())->links() }}
	@else
		{!! alert('warning', "No discussions found") !!}
	@endif
@endsection