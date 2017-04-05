<nav class="nav-main hidden-md-up">
	<div class="container">
		<ul>
			<li><a href="#" class="active" data-toggle="modal" data-target="#navGlobalMobile">Forum<div class="arrow"></div></a></li>
		</ul>
	</div>
</nav>

<div class="modal fade" id="navGlobalMobile">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Anodyne Productions</h4>
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

<nav class="nav-main hidden-sm-down">
	<div class="container">
		<ul class="hidden-sm-down pull-right">
			<li><a href="#" class="js-contact">Contact</a></li>

			@if (auth()->check())
				<li>
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="user-icon">@icon('user')</span> {{ $_user->present()->name }}</a>
						<div class="dropdown-menu">
							<a href="{{ config('anodyne.links.www') }}admin/users/{{ $_user->username }}/edit" class="dropdown-item">Edit My Profile</a>
							<div class="dropdown-divider"></div>
							<a href="#">Logout</a>
						</div>
					</div>
				</li>
			@else
				<li><a href="{{ config('anodyne.links.www') }}register">Register</a></li>
				<li><a href="{{ route('login') }}">Log In</a></li>
			@endif
		</ul>

		<ul>
			<li><a href="{{ config('anodyne.links.www') }}">Anodyne<div class="arrow"></div></a></li>
			<li><a href="{{ config('anodyne.links.nova') }}">Nova<div class="arrow"></div></a></li>
			<li><a href="{{ config('anodyne.links.xtras') }}">Xtras<div class="arrow"></div></a></li>
			<li><a href="{{ route('home') }}" class="active">Forums<div class="arrow"></div></a></li>
			<li><a href="{{ config('anodyne.links.help') }}">Help<div class="arrow"></div></a></li>
			<li class="hidden-xs-down hidden-md-up"><a href="#" class="js-contact">Contact</a></li>
			<li class="hidden-xs-down hidden-md-up"><a href="{{ config('anodyne.links.www') }}register">Register</a></li>
			<li class="hidden-xs-down hidden-md-up"><a href="{{ route('login') }}">Log In</a></li>
		</ul>
	</div>
</nav>
