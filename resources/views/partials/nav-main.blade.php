<nav class="nav-main hidden-lg-up">
	<div class="container">
		<ul>
			<li><a href="#" class="active" data-toggle="modal" data-target="#navGlobalMobile">Anodyne Forums<div class="arrow"></div></a></li>
		</ul>
	</div>
</nav>

<div class="modal fade" id="navGlobalMobile">
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

<nav class="nav-main d-flex align-items-center hidden-md-down">
	<div class="container">
		<div class="d-flex align-items-center justify-content-start">
			<div class="mr-auto d-flex justify-content-between">
				<a href="{{ config('anodyne.links.www') }}">Anodyne<div class="arrow"></div></a>
				<a href="{{ config('anodyne.links.nova') }}">Nova<div class="arrow"></div></a>
				<a href="{{ config('anodyne.links.xtras') }}">Xtras<div class="arrow"></div></a>
				<a href="{{ route('home') }}" class="active">Forums<div class="arrow"></div></a>
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
						<div class="dropdown-menu">
							<a href="{{ config('anodyne.links.www') }}admin/users/{{ $_user->username }}/edit" class="dropdown-item">Edit My Profile</a>
							<div class="dropdown-divider"></div>
							<a href="#">Logout</a>
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
