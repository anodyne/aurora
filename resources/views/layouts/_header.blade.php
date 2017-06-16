<div class="d-flex align-items-center justify-content-end flex-column flex-lg-row py-4 my-4">
	<div class="mr-lg-auto hidden-sm-down">
		<a href="{{ route('home') }}" class="brand d-flex align-items-center">{{ svg_icon('anodyne')->inline() }} Anodyne Forums</a>
	</div>
	<div>
		<nav class="nav-sub">
			<a href="{{ route('home') }}">All Discussions</a>
			<a href="{{ route('leaderboard') }}">Leaderboard</a>
			<a href="#">Advanced Search</a>

			@if (auth()->check())
				<a href="{{ route('discussions.create') }}" class="btn btn-outline-primary hidden-sm-down">Start Discussion</a>
				<a href="{{ route('discussions.create') }}" class="hidden-lg-up">Start Discussion</a>
			@endif
		</nav>
	</div>
</div>