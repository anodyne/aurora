@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h1>Sign In</h1>

			<p>Sign in using your AnodyneID below. Once signed in, you'll be signed in across all Anodyne sites and services that use the AnodyneID. If you don't have an AnodyneID, you can get one by {{ link_to('https://anodyne-productions.com/register', 'registering') }}.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 offset-md-3">
			{{ Form::open(['url' => '/login']) }}
				<div class="form-group{{ ($errors->has('email')) ? ' has-danger' : '' }}">
					<label class="form-control-label sr-only">Email Address</label>
					<input type="email" name="email" class="form-control form-control-lg" placeholder="Email Address">
					{!! $errors->first('email', '<p class="form-control-feedback">:message</p>') !!}
				</div>

				<div class="form-group{{ ($errors->has('password')) ? ' has-danger' : '' }}">
					<label class="form-control-label sr-only">Password</label>
					<input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
					{!! $errors->first('password', '<p class="form-control-feedback">:message</p>') !!}
				</div>

				<div class="form-group">
					{{ Form::button('Sign In', ['type' => 'submit', 'class' => 'btn btn-lg btn-block btn-primary']) }}
					<a href="https://anodyne-productions.com/register" class="btn btn-block btn-link">Register Now</a>
					<a href="https://anodyne-productions.com/password/reset" class="btn btn-block btn-link">Forgot Your Password?</a>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection