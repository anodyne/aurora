<template>
	<div>
		<div v-if="signedIn">
			<hr>

			<div class="media">
				<div class="media-left">
					<span class="hidden-sm-down">
						<avatar type="image" :user="user"></avatar>
					</span>
				</div>
				<div class="media-body">
					<div class="form-group">
						<div class="quill-editor-sm" id="quick-reply-editor"></div>
						<textarea name="body" class="form-control hidden" v-model="body"></textarea>
					</div>
					<div class="form-group">
						<button type="submit"
							    class="btn btn-primary"
							    @click="addReply">Reply</button>
					</div>
				</div>
			</div>
		</div>

		<div v-else>
			<p class="lead text-center">Please sign in to participate in this discussion.</p>
		</div>
	</div>
</template>

<script>
	import Quill from 'quill';

	export default {
		data () {
			return {
				body: '',
				editor: false
			}
		},

		computed: {
			signedIn () {
				return window.App.signedIn;
			},

			user () {
				return window.App.user;
			}
		},

		methods: {
			addReply () {
				var self = this;

				axios.post(location.pathname + '/replies', { body: this.body })
					.then(response => {
						self.body = '';
						self.editor.container.firstChild.innerHTML = '';

						self.$emit('created', response.data);

						flash('Your reply has been posted.');
					});
			}
		},

		mounted () {
			let self = this;

			this.editor = new Quill('#quick-reply-editor', {
				modules: {
					toolbar: [
						['bold', 'italic', 'underline'],
						['blockquote', 'code-block'],
						['link', 'image'],
						[{ 'header': [2, 3, false] }],
						[{ 'list': 'ordered'}, { 'list': 'bullet' }]
					]
				},
				placeholder: "Reply to this discussion now...",
				theme: 'bubble'
			});

			this.editor.on('text-change', function (delta) {
				self.body = self.editor.container.firstChild.innerHTML;
			});
		}
	}
</script>