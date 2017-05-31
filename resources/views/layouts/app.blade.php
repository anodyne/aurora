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
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v2') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png') }}">

		<!-- Scripts -->
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
		<div class="wrapper">
			<header>
				<nav class="nav-main hidden-lg-up">
					<div class="container">
						<ul>
							<li><a href="#" class="active logo" data-toggle="modal" data-target="#navGlobalMobile">@icon('anodyne') Forums</a></li>
						</ul>
					</div>
				</nav>

				<nav class="nav-main hidden-md-down d-flex align-items-center">
					<div class="container">
						<div class="d-flex align-items-center justify-content-start">
							<div class="mr-auto d-flex justify-content-between">
								<a href="{{ config('anodyne.links.www') }}">Anodyne<div class="arrow"></div></a>
								<a href="{{ config('anodyne.links.nova') }}">Nova<div class="arrow"></div></a>
								<a href="{{ config('anodyne.links.xtras') }}">Xtras<div class="arrow"></div></a>
								<a href="{{ route('home') }}" class="active logo">{{ svg_icon('anodyne')->inline() }} Forums<div class="arrow"></div></a>
								<a href="{{ config('anodyne.links.help') }}">Help<div class="arrow"></div></a>
							</div>
							<div class="d-flex align-items-center">
								<a href="#" class="js-contact">Contact</a>

								@if (auth()->check())
									<div class="dropdown">
										<a href="#" data-toggle="dropdown" class="dropdown-toggle d-flex align-items-center user-avatar">
											<span class="pr-2">{!! avatar($_user)->image()->tiny() !!}</span>
											{{ $_user->present()->name }}
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="{{ route('profile', $_user) }}" class="dropdown-item">My Profile</a>
											<a href="{{ config('anodyne.links.www') }}admin/users/{{ $_user->username }}/edit" class="dropdown-item">Edit My Profile</a>
											<div class="dropdown-divider"></div>

											@if ($_user->hasRole('Forums Administrator'))
												<h6 class="dropdown-header">Admin</h6>
												<a href="{{ route('topics.index') }}" class="dropdown-item">Manage Topics</a>
												<div class="dropdown-divider"></div>
											@endif

											<a href="#" class="dropdown-item">Logout</a>
										</div>
									</div>
								@else
									<a href="{{ config('anodyne.links.www') }}register">Register</a>
									<a href="{{ route('login') }}">Log In</a>
								@endif
							</div>
						</div>
					</div>
				</nav>

				<div class="container">
					@include('partials.header')
				</div>
			</header>

			<div class="search-forums">
				<div class="container">
					<div class="input-group">
						<span class="input-group-addon">@icon('magnifying-glass')</span>
						{!! Form::text('q', null, ['placeholder' => 'Search the forums', 'class' => 'form-control form-control-lg search-field']) !!}
					</div>
				</div>
			</div>

			<main id="app">
				<div class="container">
					@if (session()->has('flash.message'))
						@include('partials.flash')
					@endif

					@yield('content')
				</div>

				<flash message="{{ session('flash') }}"></flash>
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
		<div id="navGlobalMobile" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Anodyne Productions</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<div class="modal-body">
						<ul>
							<li><a href="{{ config('anodyne.links.www') }}">Anodyne</a></li>
							<li><a href="{{ config('anodyne.links.nova') }}">Nova</a></li>
							<li><a href="{{ config('anodyne.links.xtras') }}">Xtras</a></li>
							<li><a href="{{ route('home') }}">Forums</a></li>
							<li><a href="{{ config('anodyne.links.help') }}">Help</a></li>
							<li><a href="#" class="js-contact">Contact</a></li>
							<li><a href="{{ config('anodyne.links.www') }}register">Register</a></li>
							<li><a href="{{ route('login') }}">Log In</a></li>
						</ul>
					</div>
					<div class="modal-footer">
						<a href="#" data-dismiss="modal" class="btn btn-lg btn-block btn-default">Close</a>
					</div>
				</div>
			</div>
		</div>
		@yield('modals')

		{{ svg_spritesheet() }}

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/functions.js') }}"></script>
		@stack('scripts')
		<script>
			window.Anodyne = <?php echo json_encode(app('anodyne')->scriptVariables());?>

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
