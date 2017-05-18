<template>
	<div>
		<div v-for="(reply, index) in items">
			<reply :discussion="discussion" :reply="reply" @deleted="remove(index)"></reply>
		</div>

		<div>
			<div class="discussion-summary">
				<svg class="icon text-subtle">
					<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bell"></use>
				</svg>
				<label>
					<input type="checkbox"> Notify me when there are replies to this discussion
				</label>
			</div>
		</div>

		<quick-reply :endpoint="endpoint" @created="add"></quick-reply>
	</div>
</template>

<script>
	import Reply from './Reply.vue'
	import QuickReply from './QuickReply.vue'

	export default {
		props: ['discussion', 'replies'],

		components: { Reply, QuickReply },

		data () {
			return {
				endpoint: location.pathname + '/replies',
				items: this.replies
			}
		},

		methods: {
			add (reply) {
				this.items.push(reply)

				this.$emit('added')
			},

			remove (index) {
				this.items.splice(index, 1)

				this.$emit('removed')

				flash('Reply was deleted.')
			}
		}
	}
</script>