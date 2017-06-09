@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h1>Log In</h1>

			<p>Log in using your AnodyneID below. Once logged in, you'll be logged in across all Anodyne sites and services that use the AnodyneID. If you don't have an AnodyneID, you can get one by {{ link_to('https://anodyne-productions.com/register', 'registering') }}.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 offset-md-3">
			{{ Form::open(['url' => '/login']) }}
				<div class="form-group{{ ($errors->has('email')) ? ' has-danger' : '' }}">
					<label class="form-control-label">Email Address</label>
					{{ Form::text('email', null, array('type' => 'email', 'class' => 'form-control form-control-lg')) }}
					{!! $errors->first('email', '<p class="form-control-feedback">:message</p>') !!}
				</div>

				<div class="form-group{{ ($errors->has('password')) ? ' has-danger' : '' }}">
					<label class="form-control-label">Password</label>
					{{ Form::password('password', array('class' => 'form-control form-control-lg')) }}
					{!! $errors->first('password', '<p class="form-control-feedback">:message</p>') !!}
				</div>

				<div class="form-group">
					{{ Form::button('Log In', ['type' => 'submit', 'class' => 'btn btn-lg btn-block btn-primary']) }}
					<a href="https://anodyne-productions.com/register" class="btn btn-block btn-link">Register Now</a>
					<a href="https://anodyne-productions.com/password/reset" class="btn btn-block btn-link">Forgot Your Password?</a>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
