@extends('layouts.app')

@section('content')
	<h1>Start a Discussion</h1>

	{!! Form::open(['route' => 'discussions.store']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Pick a Topic</label>
					{!! Form::select('topic_id', $topics, null, ['class' => 'form-control', 'placeholder' => 'Choose a topic for your discussion']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Title</label>
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label class="control-label">Content</label>
					<div id="editor"></div>
				</div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::button("Start Discussion", ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
			<a href="{{ route('home') }}" class="btn btn-link-secondary ml-2">Cancel</a>
		</div>
	{!! Form::close() !!}
@endsection

@push('styles')
	<link href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endpush