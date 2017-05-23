@extends('layouts.app')

@section('title', 'Add a Topic')

@section('content')
	<h1>Add a Topic</h1>

	{!! Form::open(['route' => 'topics.store']) !!}
		<div class="row">
			<div class="col-md-4">
				<div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
					<label>Name</label>
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
					{!! $errors->first('name', '<p class="form-control-feedback">:message</p>') !!}
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label>Slug</label>
					{!! Form::text('slug', null, ['class' => 'form-control']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Parent Topic</label>
					{!! Form::select('parent_id', $topics, null, ['class' => 'form-control', 'placeholder' => 'No parent']) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Color</label>
					{!! Form::text('color', null, ['class' => 'form-control jscolor {hash:true}']) !!}
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label>Description</label>
					{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) !!}
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="btn-toolbar">
				<div class="btn-group">
					{!! Form::button('Add Topic', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
				</div>
				<div class="btn-group">
					<a href="{{ route('topics.index') }}" class="btn btn-link-secondary">Cancel</a>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@endsection

@push('scripts')
	<script src="{{ asset('js/jscolor.min.js') }}"></script>
@endpush