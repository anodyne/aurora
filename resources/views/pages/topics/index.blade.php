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
				@foreach ($topic->children()->withTrashed()->get() as $child)
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

								@if ($child->trashed())
									<div class="btn-group ml-2">
										<a href="#" class="btn btn-outline-success js-restore" data-topic="{{ $child->slug }}">@icon('back-in-time')</a>
									</div>
								@else
									<div class="btn-group ml-2">
										<a href="#" class="btn btn-outline-danger js-remove">@icon('trash')</a>
									</div>
								@endif
							</div>
						</div>
					</div>
				@endforeach
			@endif
		@endforeach
	</div>
@endsection

@section('modals')
	@can('delete', Topic::class)
		{!! modal(['id' => "removeTopic", 'header' => 'Remove Topic']) !!}
	@endcan
@endsection

@section('js')
	<script>
		$('.js-restore').click(function (e) {
			e.preventDefault()

			var topic = $(this).data('topic')

			swal({   
				title: "Restore this topic?",
				type: "question",
				showCancelButton: true,
				confirmButtonClass: 'btn btn-success mr-2',
				confirmButtonText: "Yes, restore it!",
				cancelButtonClass: 'btn btn-outline-secondary ml-2',
				buttonsStyling: false
			}).then(function () {
				var url = 'http://forums.anodyne.dev:8888/admin/topics/' + topic + '/restore'
				console.log(url)
				
				axios.put(url).then(function (response) {
					swal({
						title: "Topic was restored",
						type: "success",
						confirmButtonClass: 'btn btn-secondary',
						buttonsStyling: false
					})
				}).catch(function (error) {
					swal({
						title: "Error!",
						text: error,
						type: "error",
						confirmButtonClass: 'btn btn-outline-danger',
						buttonsStyling: false
					})
				})
			}, function (dismiss) {
				if (dismiss === 'cancel') {
					swal({
						title: "Topic was not restored",
						type: "error",
						confirmButtonClass: 'btn btn-secondary',
						buttonsStyling: false
					})
				}
			})
		})
	</script>
@endsection