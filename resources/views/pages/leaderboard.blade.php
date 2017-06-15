@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
	<h1>Leaderboard</h1>

	<div class="row">
	@foreach ($users as $user)
		<div class="col-lg-6">
			<div class="card mb-4">
				<div class="card-block">
					{!! avatar($user)->medium()->link()->label(null, number_format($user->countBestAnswers())." Best Answer ".str_plural('Award', $user->countBestAnswers())) !!}
				</div>
			</div>
		</div>
	@endforeach
	</div>
@endsection