@extends('layouts.app')

@section('content')
	<div class="mb-3">
		<a href="#" class="btn btn-primary">Button</a>
		<a href="#" class="ml-2 btn btn-primary">@icon('paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-primary">Button</a>
		<a href="#" class="ml-2 btn btn-outline-primary">@icon('paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-secondary">Button</a>
		<a href="#" class="ml-2 btn btn-secondary">@icon('paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-secondary">Button</a>
		<a href="#" class="ml-2 btn btn-outline-secondary">@icon('paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-success">Button</a>
		<a href="#" class="ml-2 btn btn-success">@icon('paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-success">Button</a>
		<a href="#" class="ml-2 btn btn-outline-success">@icon('paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-danger">Button</a>
		<a href="#" class="ml-2 btn btn-danger">@icon('paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-danger">Button</a>
		<a href="#" class="ml-2 btn btn-outline-danger">@icon('paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-warning">Button</a>
		<a href="#" class="ml-2 btn btn-warning">@icon('paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-warning">Button</a>
		<a href="#" class="ml-2 btn btn-outline-warning">@icon('paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-info">Button</a>
		<a href="#" class="ml-2 btn btn-info">@icon('paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-info">Button</a>
		<a href="#" class="ml-2 btn btn-outline-info">@icon('paper-plane')</a>
	</div>

	<div class="mb-3">
		<a href="#" class="btn btn-dark">Button</a>
		<a href="#" class="ml-2 btn btn-dark">@icon('paper-plane')</a>
		<a href="#" class="ml-2 btn btn-outline-dark">Button</a>
		<a href="#" class="ml-2 btn btn-outline-dark">@icon('paper-plane')</a>
	</div>
@endsection

@section('js')
	<script>
		var vm = new Vue({
			el: '#app',

			mounted () {
				var user = window.App.user

				console.log(window.App.userAuthorization)
			}
		})
	</script>
@endsection
