<div class="modal-body">
	<p>Are you sure you want to remove the <strong>{{ $topic->name }}</strong> topic?</p>

	{!! Form::model($topic, ['route' => ['topics.destroy', $topic], 'method' => 'delete']) !!}
</div>

<div class="modal-footer">
		<button type="button" class="btn btn-outline-danger">Remove</button>
		<button type="button" class="btn btn-link-secondary" data-dismiss="modal">Cancel</button>
	{!! Form::close() !!}
</div>