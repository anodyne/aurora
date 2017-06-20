@extends('layouts.app')

@section('title')
	{{ $discussion->title }} - {{ $discussion->topic->name }}
@endsection

@section('content')
	<discussion-view :initial-replies-count="{{ $discussion->replies_count }}"
					 :discussion="{{ $discussion }}"
					 inline-template>
		<div>
			<div class="d-flex align-items-center">
				<h1 class="my-0" v-html="title"></h1>
				<subscribe-control size="lg" :discussion="{{ $discussion }}"></subscribe-control>
			</div>

			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Forum</a></li>

				@if ($topic->parent_id)
					<li class="breadcrumb-item"><a href="{{ route('topics.discussions', [$topic->parent]) }}">{{ $topic->parent->name }}</a></li>
				@endif
				
				<li class="breadcrumb-item active"><a href="{{ route('topics.discussions', [$topic]) }}">{{ $topic->name }}</a></li>
			</ol>

			<div :id="'discussion-' + discussion.id" class="media">
				<div class="media-left">
					<span class="hidden-sm-down">
						<avatar :user="discussion.author"></avatar>
					</span>
				</div>

				<div class="media-body">
					<div class="panel panel-default">
						<div class="panel-heading hidden-sm-down">
							<h3 class="panel-title mr-auto"><a :href="'/profiles/' + discussion.author.username" v-text="discussion.author.name"></a></h3>
							<small class="timestamp text-subtle js-tooltip-top" :title="formatDate(discussion.created_at, '')">Replied @{{ formatDate(discussion.created_at, 'relative') }}</small>
						</div>
						<div class="panel-heading hidden-md-up">
							<avatar :user="discussion.author" :has-label="true">
								<span slot="beforeLabel" v-cloak>@{{ formatDate(discussion.created_at, 'relative') }}</span>
							</avatar>
							<div class="dropdown">
								<a href="#" id="dropdownMenuButton" data-toggle="dropdown">
									<svg class="icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-dots-three-vertical"></use>
									</svg>
								</a>
								
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#" @click.prevent="editing = true" v-if="canUpdate">Edit</a>
									<a class="dropdown-item" href="#" @click.prevent="destroy" v-if="canDelete">Delete</a>
									<div class="dropdown-divider" v-if="canUpdate"></div>
									<a class="dropdown-item" href="#" @click.prevent="copyLink">Copy Link</a>
									{{-- <a class="dropdown-item" href="#">Message @{{ reply.author.name }}</a> --}}
									<a class="dropdown-item" href="#">Report</a>
								</div>
							</div>
						</div>

						<div class="panel-body">
							<div v-show="editing" v-cloak>
								<div class="form-group">
									<div class="editor" v-html="body"></div>
									<textarea name="body" class="form-control hidden" v-model="body"></textarea>
								</div>

								<div class="btn-toolbar">
									<div class="btn-group">
										<button class="btn btn-primary" @click.prevent="update">Update</button>
									</div>
									<div class="btn-group">
										<button class="btn btn-link-secondary" @click.prevent="editing = false">Cancel</button>
									</div>
								</div>
							</div>

							<div v-show="!editing">
								<div v-html="body"></div>

								<div class="post-signature" v-if="signature">
									<div v-html="marked(signature)"></div>
								</div>
							</div>
						</div>

						<div v-if="signedIn">
							<div class="panel-footer hidden-sm-down">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										{{-- <favorite :reply="reply"></favorite> --}}
									</div>
								</div>

								<div class="dropdown dropup">
									<a href="#" id="dropdownMenuButton" class="btn" data-toggle="dropdown">
										<svg class="icon">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-dots-three-vertical"></use>
										</svg>
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#" @click.prevent="editing = true" v-if="canUpdate">Edit</a>
										<a class="dropdown-item" href="#" @click.prevent="destroy" v-if="canDelete">Delete</a>
										<div class="dropdown-divider" v-if="canUpdate"></div>
										<a class="dropdown-item" href="#" @click.prevent="copyLink">Copy Link</a>
										{{-- <a class="dropdown-item" href="#">Message @{{ reply.author.name }}</a> --}}
										<a class="dropdown-item" href="#">Report</a>
									</div>
								</div>
							</div>

							<div class="panel-footer hidden-md-up">
								{{-- <favorite :reply="reply" v-if="signedIn"></favorite> --}}
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- {!! view('pages.discussions._post-first')->with('post', $discussion) !!} --}}

			<div>
				<div class="discussion-summary">
					@icon('icon-chat', 'text-subtle')

					<span>
						<span v-if="hasAnswer" v-cloak>Answered with </span>
						<span v-text="repliesCountNice"></span>
						<span v-text="repliesLabel"></span>
					</span>
				</div>
			</div>

			<div v-if="discussion.replies_count > 1">
				<reply :discussion="discussion" :reply="discussion.answer"></reply>
			</div>

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