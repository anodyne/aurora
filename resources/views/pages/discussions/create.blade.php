@extends('layouts.app')

@section('content')
	<h1>Start a Discussion</h1>

	<create-discussion inline-template>
		{!! Form::open(['route' => 'discussions.store']) !!}
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="sr-only">Pick a Topic</label>
						{!! Form::topics() !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="sr-only">Title</label>
						{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Discussion title']) !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label class="sr-only">Content</label>
						<div id="editor"></div>
						<textarea name="body" class="form-control hidden" v-model="body"></textarea>
					</div>
				</div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Start Discussion</button>
				<a href="{{ route('home') }}" class="btn btn-link-secondary ml-2">Cancel</a>
			</div>
		{!! Form::close() !!}
	</create-discussion>
@endsection

@section('js')
	<script>
		var vue = new Vue({
			el: "#app"
		});
	</script>
@endsection