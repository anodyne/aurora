@extends('layouts.app')

@section('title')
	{{ $discussion->title }} - {{ $discussion->topic->name }}
@endsection

@section('content')
	<discussion-view :initial-replies-count="{{ $discussion->replies_count }}" inline-template>
		<div>
			<div class="d-flex align-items-center">
				<h1 class="my-0">{{ $discussion->title }}</h1>
				<subscribe-control size="lg" :discussion="{{ $discussion }}"></subscribe-control>
			</div>

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
					@icon('icon-chat', 'text-subtle')

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

			<replies :discussion="{{ $discussion }}"
					 @added="repliesCount++"
					 @removed="repliesCount--"></replies>
		</div>
	</discussion-view>
@endsection

@push('scripts')
	<script src="{{ asset('js/highlight.pack.js') }}"></script>
	<script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
@endpush

@push('styles')
	<link rel="stylesheet" href="{{ asset('css/highlight-solarized-dark.css') }}">
@endpush

@section('js')
	<script>
		var vue = new Vue({
			el: "#app",

			mounted () {
				$('pre.ql-syntax').each(function (i, block) {
					hljs.highlightBlock(block);
				});
			}
		});
	</script>
@endsection