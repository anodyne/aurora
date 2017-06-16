@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
	<h1>Leaderboard</h1>

	<div class="row">
	@foreach ($users as $user)
		<div class="col-lg-6">
			<div class="card mb-4">
				<div class="card-block">
					<div class="d-flex align-items-center">
						{!! avatar($user)->medium()->link() !!}
						<div class="d-flex flex-column pl-3">
							<p class="lead my-0"><a href="{{ route('profile', $user) }}">{{ $user->name }}</a></p>
							<p class="mt-1 mb-0">{{ number_format($user->countBestAnswers()) }} Best Answer {{ str_plural('Award', $user->countBestAnswers()) }}</p>
							<p class="mt-1 mb-0">{{ number_format($user->points) }} Experience</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	</div>
@endsection