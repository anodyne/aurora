<script>
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
				hasAnswer: false,
				repliesCount: this.initialRepliesCount
			}
		},

		computed: {
			repliesCountNice () {
				if (this.repliesCount == 0) {
					return 'No';
				}

				return this.repliesCount;
			},

			repliesLabel () {
				return pluralize('reply', this.repliesCount);
			}
		},

		mounted () {
			this.hasAnswer = this.discussion.answer_id != null;

			let self = this;

			EventBus.$on('discussion-answered', reply => {
				self.discussion.answer_id = reply;
				self.hasAnswer = true;
			});
		}
	};
</script>