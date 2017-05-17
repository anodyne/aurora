<script>
	import pluralize from 'pluralize'
	import Replies from '../components/Replies.vue'

	export default {
		props: ['initialRepliesCount'],

		components: { Replies },

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