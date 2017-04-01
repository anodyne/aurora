<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Anodyne Productions">
    <meta name="description" content="Anodyne Productions specializes in RPG management software and tools to help game masters play and run their games with powerful and easy-to-use software.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v1') }}">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div class="wrapper" id="app">
		{!! partial('nav-main') !!}

		<header>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-4 col-lg-5">
						<a href="{{ route('home') }}" class="brand">Anodyne Forums</a>
					</div>

					<div class="col-xs-12 col-md-8 col-lg-7">
						<nav class="nav-sub">
							<ul>
								<li><a href="{{ route('home') }}">All Discussions</a></li>
								<li><a href="#">Leaderboard</a></li>

								@if (auth()->check())
									<li><a href="#">My Discussions</a></li>
								@endif

								<li><a href="#">Advanced Search</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>

		<div class="search-forums">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon">@icon('magnifying-glass')</span>
							{!! Form::text('q', null, ['placeholder' => 'Search the forums', 'class' => 'form-control form-control-lg search-field']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>

        <main>
			<div class="container">
				@if (session()->has('flash.message'))
					@include('partials.flash')
				@endif

				@yield('content')
			</div>
		</main>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-9 col-md-10">
						<h2>Anodyne Forums</h2>

						<p>Our mission is simple: provide products of the highest quality. That's been the driving force behind our efforts since the day we opened our doors; we don't just want to meet your expectations for powerful and easy-to-use web software, we want to exceed it.</p>

						<p>&copy; {{ Date::now()->year }} Anodyne Productions</p>
					</div>
					<div class="col-sm-3 col-md-2">
						<ul class="list-unstyled">
							<li><a href="#">Home</a></li>
							<li><a href="#">Nova</a></li>
							<li><a href="#">AnodyneXtras</a></li>
							<li><a href="#">Forums</a></li>
							<li><a href="#" @click.prevent="contact">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
    </div>

	<div id="contactModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content"></div>
		</div>
	</div>
	@yield('modals')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	@stack('scripts')
    <script>
        $(function() {
            $('.js-tooltip-top').tooltip({ placement: 'top' })
            $('.js-tooltip-bottom').tooltip({ placement: 'bottom' })
            $('.js-tooltip-left').tooltip({ placement: 'left' })
            $('.js-tooltip-right').tooltip({ placement: 'right' })
        })
    </script>
	@yield('js')
</body>
</html>
