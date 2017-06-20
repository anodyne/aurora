<script>
	import Quill from 'quill';
	import copy from 'copy-to-clipboard';
	import pluralize from 'pluralize';
	import Reply from '../components/Reply.vue';
	import Replies from '../components/Replies.vue';
	import SubscribeControl from '../components/SubscribeControl.vue';
	import { EventBus } from '../mixins/EventBus.js';

	export default {
		props: ['initialRepliesCount', 'discussion'],

		components: { Reply, Replies, SubscribeControl },

		data () {
			return {
				body: this.discussion.body,
				editing: false,
				hasAnswer: false,
				repliesCount: this.initialRepliesCount,
				signature: this.discussion.author.signature,
				title: this.discussion.title,
				updatedBody: '',
				updatedTitle: ''
			}
		},

		computed: {
			canDelete () {
				return this.authorize(user => false);
			},
			
			canUpdate () {
				return this.authorize(user => this.discussion.user_id == user.id);
			},

			repliesCountNice () {
				if (this.repliesCount == 0) {
					return 'No';
				}

				return this.repliesCount;
			},

			repliesLabel () {
				return pluralize('reply', this.repliesCount);
			},

			signedIn () {
				return window.App.signedIn;
			}
		},

		methods: {
			copyLink () {
				copy(window.App.siteUrl + '/discussions/' + this.discussion.topic.slug + '/' + this.discussion.id);

				flash('Link to discussion copied to clipboard.');
			},

			destroy () {
				axios.delete('/replies/' + this.reply.id);

				this.$emit('deleted', this.reply.id);

				flash('Deleted the discussion.');
			},

			like () {
				axios.post('/replies/' + this.reply.id + '/favorites');

				flash('Liked the discussion.');
			},

			update () {
				this.editing = false;
				this.body = this.updatedBody;
				this.title = this.updatedTitle;

				axios.patch('/discussions/' + this.discussion.topic.slug + '/' + this.discussion.id, {
					body: this.body,
					title: this.title
				});

				flash('Updated the discussion.');
			}
		},

		mounted () {
			let self = this;
			let id = "#discussion-" + this.discussion.id;

			this.editor = new Quill(id + ' .editor', {
				modules: {
					toolbar: [
						['bold', 'italic', 'underline'],
						['blockquote', 'code-block'],
						['link', 'image'],
						[{ 'header': [2, 3, false] }],
						[{ 'list': 'ordered'}, { 'list': 'bullet' }]
					]
				},
				theme: 'bubble'
			});

			this.editor.on('text-change', function (delta) {
				self.updatedBody = self.editor.container.firstChild.innerHTML;
			});

			this.hasAnswer = this.discussion.answer_id != null;

			EventBus.$on('discussion-answered', reply => {
				self.discussion.answer_id = reply;
				self.hasAnswer = true;
			});
		}
	};
</script>