@extends('layouts.app')

@section('title', 'Manage Announcements')

@section('content')
	<h1>Manage Announcements</h1>

	<div class="btn-toolbar">
		<div class="btn-group">
			<a href="{{ route('announcements.create') }}" class="btn btn-primary">Add Announcement</a>
		</div>
	</div>

	<announcements :announcements="{{ $announcements }}"></announcements>
@endsection

@section('js')
	<script>
		var vm = new Vue({
			el: '#app'
		})
	</script>
@endsection