@extends('layouts.app')

@section('content')
	<p>{!! avatar(User::find(36))->image()->label()->tiny() !!}</p>

	<p>{!! avatar(User::find(18))->image()->label()->small() !!}</p>

	<p>{!! avatar(User::find(52))->image()->label() !!}</p>

	<p>{!! avatar(User::find(4))->image()->label()->medium() !!}</p>

	<p>{!! avatar(User::find(1))->image()->label()->large() !!}</p>
@endsection
