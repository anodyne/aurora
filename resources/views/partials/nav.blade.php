<nav class="nav-main hidden-lg-up">
	<div class="container">
		<ul>
			<li><a href="#" class="active logo" data-toggle="modal" data-target="#navGlobalMobile">{{ svg_icon('anodyne')->inline() }} Forums</a></li>
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
					<user-notifications></user-notifications>
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle d-flex align-items-center user-avatar">
							<span class="pr-2">{!! avatar($_user)->image()->tiny() !!}</span>
							<span>{{ $_user->present()->name }}</span>
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