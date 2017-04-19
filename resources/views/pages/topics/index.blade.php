@extends('layouts.app')

@section('title', 'Manage Topics')

@section('content')
	<h1>Manage Topics</h1>

	<div class="btn-toolbar">
		<div class="btn-group">
			<a href="{{ route('topics.create') }}" class="btn btn-primary">Add Topic</a>
		</div>
	</div>

	<div class="data-table striped bordered">
		@foreach ($topics as $topic)
			<div class="row d-flex align-items-center">
				<div class="col-md-9 d-flex align-items-center">
					<span class="badge badge-pill" style="background-color:{{ $topic->color }}">&nbsp;</span>
					<p class="lead pl-2">{{ $topic->name }}</p>
				</div>
				<div class="col-md-3 controls">
					<div class="btn-toolbar float-right">
						<div class="btn-group">
							<a href="{{ route('topics.edit', [$topic]) }}" class="btn btn-secondary">@icon('edit')</a>
						</div>
						<div class="btn-group ml-2">
							@if ($topic->trashed())
								{!! Form::model($topic, ['route' => ['topics.restore', $topic], 'method' => 'put']) !!}
									<button type="submit" class="btn btn-outline-success">@icon('back-in-time')</button>
								{!! Form::close() !!}
							@else
								<a href="#" class="btn btn-outline-danger js-remove">@icon('trash')</a>
							@endif
						</div>
					</div>
				</div>
			</div>

			@if ($topic->has('children'))
				@foreach ($topic->children as $child)
					<div class="row d-flex align-items-center">
						<div class="col-md-9 d-flex align-items-center">
							<span class="badge badge-pill ml-4" style="background-color:{{ $child->color }}">&nbsp;</span>
							<p class="lead pl-2">{{ $child->name }}</p>
						</div>
						<div class="col-md-3 controls">
							<div class="btn-toolbar float-right">
								<div class="btn-group">
									<a href="{{ route('topics.edit', [$child]) }}" class="btn btn-secondary">@icon('edit')</a>
								</div>
								<div class="btn-group ml-2">
									@if ($child->trashed())
										{!! Form::model($child, ['route' => ['topics.restore', $child], 'method' => 'put']) !!}
											<button type="submit" class="btn btn-outline-success">@icon('back-in-time')</button>
										{!! Form::close() !!}
									@else
										<a href="#" class="btn btn-outline-danger js-remove">@icon('trash')</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		@endforeach
	</div>
@endsection

@section('modals')
	@can('delete', $topic)
		{!! modal(['id' => "removeTopic", 'header' => 'Remove Topic']) !!}
	@endcan
@endsection

@section('js')
	<script>
		var topic
		var identifier = '#removeTopic'
		var url = anodyneUrl("/admin/topics/" + topic + "/remove")
		
		$(identifier + ' .modal-content').load(url, function () {
			$(identifier).modal('show')
		})

		$('.js-remove').on('click', function () {
			// Do an Ajax call to grab the content for the modal
			$.ajax({
				url: '{{ route('topics.remove', [$topic]) }}',
				success: function (data) {
					$('#removeTopic .modal-content-container').html(data)
				}
			})

			$('#removeTopic').modal('show')
		})
	</script>
@endsection