@extends('layouts.app')

@section('title', 'Edit Announcement')

@section('content')
	<h1>Edit Announcement</h1>

	{!! Form::model($announcement, ['route' => ['announcements.update', $announcement->id]]) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('title') ? 'has-danger' : '' }}">
					<label>Title</label>
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
					{!! $errors->first('title', '<p class="form-control-feedback">:message</p>') !!}
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label>Body</label>
					{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 8]) !!}
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="btn-toolbar">
				<div class="btn-group">
					{!! Form::button('Update Announcement', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
				</div>
				<div class="btn-group">
					<a href="{{ route('announcements.index') }}" class="btn btn-link-secondary">Cancel</a>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script>
		var vm = new Vue({
			el: '#app'
		})
	</script>
@endsection