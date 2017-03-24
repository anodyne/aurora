@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
	        <div class="panel panel-default">
	            <div class="panel-heading">Start a New Discussion</div>

	            <div class="panel-body">
	                {!! Form::open(['route' => 'discussions.store']) !!}
						<div class="form-group">
							<label>Title</label>
							{!! Form::text('title', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group">
							<label>Body</label>
							{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 10]) !!}
						</div>

						{!! Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	</div>
@endsection
