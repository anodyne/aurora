<script>
	import pluralize from 'pluralize'
	import Replies from '../components/Replies.vue'
	import SubscribeControl from '../components/SubscribeControl.vue'

	export default {
		props: ['initialRepliesCount'],

		components: { Replies, SubscribeControl },

		data () {
			return {
				repliesCount: this.initialRepliesCount
			}
		},

		computed: {
			repliesLabel () {
				return pluralize('reply', this.repliesCount)
			}
		}
	}
</script>