@extends('layouts.app')

@section('content')
	<discussion-view :initial-replies-count="{{ $discussion->replies_count }}" inline-template>
		<div>
			<h1>{{ $discussion->title }}</h1>

			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Forum</a></li>

				@if ($topic->parent_id)
					<li class="breadcrumb-item"><a href="{{ route('topics.discussions', [$topic->parent]) }}">{{ $topic->parent->name }}</a></li>
				@endif
				
				<li class="breadcrumb-item active"><a href="{{ route('topics.discussions', [$topic]) }}">{{ $topic->name }}</a></li>
			</ol>

			{!! view('pages.discussions._post-first')->with('post', $discussion) !!}

			<div>
				<div class="discussion-summary">
					@icon('chat', 'text-subtle')

					<span>
						<span v-text="repliesCount"></span>
						<span v-text="repliesLabel"></span>

						@if ($discussion->isAnswered())
							with 1 correct answer
						@endif
					</span>
				</div>
			</div>

			@if ($discussion->isAnswered())
				{!! view('pages.discussions._post-reply', ['reply' => $discussion->answer(), 'discussion' => $discussion]) !!}
			@endif

			<replies :discussion="{{ $discussion }}" :replies="{{ $discussion->replies }}" @removed="repliesCount--"></replies>

			{{ $replies->links() }}

			<div>
				<div class="discussion-summary">
					@icon('bell', 'text-subtle')
					<label>
						<input type="checkbox"> Notify me when there are replies to this discussion
					</label>
				</div>
			</div>

			@if (auth()->check())
				<hr>

				<div class="media">
					<div class="media-left">
						<span class="hidden-sm-down">{!! avatar($_user)->image() !!}</span>
					</div>
					<div class="media-body">
						{!! Form::open(['route' => ['discussions.replies', $topic, $discussion]]) !!}
							<div class="form-group">
								{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Reply to this discussion now...']) !!}
							</div>
							<div class="form-group">
								{!! Form::button('Reply', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			@endif
		</div>
	</discussion-view>
@endsection

@push('scripts')
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/highlight.min.js"></script>
@endpush

@push('styles')
	<link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/solarized-dark.min.css" rel="stylesheet">
@endpush

@section('js')
	<script>
		var vue = new Vue({
			el: "#app"
		})
		
		hljs.initHighlightingOnLoad()
	</script>
@endsection