@extends('layouts.app')

@section('title', 'Manage Topics')

@section('content')
	<h1>Manage Topics</h1>

	<div class="btn-toolbar">
		<div class="btn-group">
			<a href="{{ route('topics.create') }}" class="btn btn-primary">Add Topic</a>
		</div>
	</div>

	<topics :topics="{{ $topics }}"></topics>
@endsection

@section('js')
	<script>
		var vm = new Vue({
			el: '#app'
		});
	</script>
@endsection