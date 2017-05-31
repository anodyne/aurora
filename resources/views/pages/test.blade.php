@extends('layouts.app')

@section('content')
	{{ svg_icon('icon-warning', 'lg text-primary')->sprite() }}

	<div class="mb-3">
		<a href="#" class="btn btn-primary">Button</a>
		<a href="#" class="ml-2 btn btn-primary">@icon('icon-chat')</a>
		<a href="#" class="ml-2 btn btn-outline-primary">Button</a>
		<a href="#" class="ml-2 btn btn-outline-primary">@icon('icon-paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-secondary">Button</a>
		<a href="#" class="ml-2 btn btn-secondary">@icon('icon-paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-secondary">Button</a>
		<a href="#" class="ml-2 btn btn-outline-secondary">@icon('icon-paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-success">Button</a>
		<a href="#" class="ml-2 btn btn-success">@icon('icon-paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-success">Button</a>
		<a href="#" class="ml-2 btn btn-outline-success">@icon('icon-paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-danger">Button</a>
		<a href="#" class="ml-2 btn btn-danger">@icon('icon-paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-danger">Button</a>
		<a href="#" class="ml-2 btn btn-outline-danger">@icon('icon-paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-warning">Button</a>
		<a href="#" class="ml-2 btn btn-warning">@icon('icon-paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-warning">Button</a>
		<a href="#" class="ml-2 btn btn-outline-warning">@icon('icon-paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-info">Button</a>
		<a href="#" class="ml-2 btn btn-info">@icon('icon-paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-info">Button</a>
		<a href="#" class="ml-2 btn btn-outline-info">@icon('icon-paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-dark">Button</a>
		<a href="#" class="ml-2 btn btn-dark">@icon('icon-paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-dark">Button</a>
		<a href="#" class="ml-2 btn btn-outline-dark">@icon('icon-paper-plane')</a>
	</div>
@endsection

@section('js')
	<script>
		var vm = new Vue({
			el: '#app'
		})
	</script>
@endsection
