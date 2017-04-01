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
					{!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 15]) !!}
				</div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::button("Start Discussion", ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
