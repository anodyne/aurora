@extends('layouts.app')

@section('title', 'Home')

@section('content')
	<div class="row">
		<div class="col-md-4 col-lg-3">
			{!! partial('forum-controls', ['topics' => $topics]) !!}
		</div>

		<div class="col-md-8 col-lg-9">
			@if ($discussions->total() > 0)
				{!! partial('discussions-list', ['discussions' => $discussions]) !!}

				{{ $discussions->appends(request()->all())->links() }}
			@else
				{!! alert('warning', "No discussions found") !!}
			@endif
		</div>
	</div>
@endsection

@section('js')
	<script>
		var vue = new Vue({
			el: "#app"
		});
	</script>
@endsection