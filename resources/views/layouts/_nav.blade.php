<!-- Nav for XS, SM, and MD screens -->
<nav class="nav-main hidden-lg-up">
	<div class="container">
		<ul>
			<li><a href="#" class="active logo" data-toggle="modal" data-target="#navGlobalMobile">{{ svg_icon('anodyne')->inline() }} Forums</a></li>
		</ul>
	</div>
</nav>

<!-- Nav for LG and XL screens -->
<nav class="nav-main hidden-md-down">
	<div class="container">
		<div class="nav-container">
			<div class="nav-left">
				<a href="{{ config('anodyne.links.www') }}">Anodyne</a>
				<a href="{{ config('anodyne.links.nova') }}">Nova</a>
				<a href="{{ config('anodyne.links.xtras') }}">Xtras</a>
				<a href="{{ route('home') }}" class="active logo">{{ svg_icon('anodyne')->inline() }} Forums</a>
				<a href="{{ config('anodyne.links.help') }}">Help</a>
			</div>
			<div class="nav-right">
				<a href="#" class="js-contact">@icon('icon-paper-plane')</a>

				@if ($_user)
					<user-notifications :initial-notifications-count="{{ $_user->unreadNotifications->count() }}"></user-notifications>
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">
							<span class="mr-2">{!! avatar($_user)->image()->tiny() !!}</span>
							<span>{{ $_user->present()->name }}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="{{ route('profile', $_user) }}" class="dropdown-item">My Profile</a>
							<a href="{{ config('anodyne.links.www') }}admin/users/{{ $_user->username }}/edit" class="dropdown-item">Edit My Profile</a>
							<div class="dropdown-divider"></div>

							@if ($_user->hasRole('Forums Administrator'))
								<h6 class="dropdown-header">Admin</h6>
								<a href="{{ route('topics.index') }}" class="dropdown-item">Topics</a>
								<div class="dropdown-divider"></div>
							@endif

							<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();flash('See you next time!');">Sign Out</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</div>
				@else
					<a href="{{ config('anodyne.links.www') }}register">Register</a>
					<a href="{{ route('login') }}">Sign In</a>
				@endif
			</div>
		</div>
	</div>
</nav>