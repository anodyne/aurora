<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Anodyne Productions">
		<meta name="description" content="Anodyne Productions specializes in RPG management software and tools to help game masters play and run their games with powerful and easy-to-use software.">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v2') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png') }}">

		<script>
			window.App = {!! json_encode([
				'csrfToken' => csrf_token(),
				'signedIn' => auth()->check(),
				'siteUrl' => request()->root(),
				'timezone' => config('app.timezone'),
				'user' => auth()->user(),
			]) !!}
		</script>

		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
		@stack('styles')
		@yield('css')
	</head>
	<body>
		<div id="app" class="wrapper">
			<header>
				@include('partials.nav')

				<div class="container">
					@include('partials.header')
				</div>
			</header>

			<div class="search-forums">
				<div class="container">
					<div class="input-group">
						<span class="input-group-addon">@icon('icon-magnifying-glass')</span>
						{!! Form::text('q', null, ['placeholder' => 'Search the forums', 'class' => 'form-control form-control-lg search-field']) !!}
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

				<flash message="{{ session('flash') }}"></flash>
			</main>

			<notification-panel></notification-panel>

			@include('partials.footer')
		</div>

		@include('partials.site-modals')
		@yield('modals')

		{{ svg_spritesheet() }}

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/functions.js') }}"></script>
		@stack('scripts')
		<script>
			window.Anodyne = <?php echo json_encode(app('anodyne')->scriptVariables());?>

			$(function () {
				$('.js-tooltip-top').tooltip({ placement: 'top' });
				$('.js-tooltip-bottom').tooltip({ placement: 'bottom' });
				$('.js-tooltip-left').tooltip({ placement: 'left' });
				$('.js-tooltip-right').tooltip({ placement: 'right' });

				$('.js-notifications').click(function (e) {
					e.preventDefault();

					$('#notification-panel').modal('show');
				});
			});
		</script>
		@yield('js')
	</body>
</html>