<template>
	<div>
		<div v-for="(reply, index) in items" :key="reply.id">
			<reply :discussion="discussion" :reply="reply" @deleted="remove(index)"></reply>
		</div>

		<paginator :data-set="dataSet" @changed="fetch"></paginator>

		<subscribe-control :initial-is-subscribed="discussion.isSubscribedTo"></subscribe-control>

		<quick-reply @created="add"></quick-reply>
	</div>
</template>

<script>
	import Reply from './Reply.vue'
	import QuickReply from './QuickReply.vue'
	import collection from '../mixins/collection'
	import SubscribeControl from './SubscribeControl.vue'

	export default {
		props: ['discussion'],

		components: { Reply, QuickReply, SubscribeControl },

		mixins: [collection],

		data () {
			return {
				dataSet: false
			}
		},

		methods: {
			fetch (page) {
				axios.get(this.url(page)).then(this.refresh)
			},

			refresh ({data}) {
				this.dataSet = data
				this.items = data.data

				window.scrollTo(0, 0)
			},

			url (page) {
				if (! page) {
					let query = location.search.match(/page=(\d)/)

					page = query ? query[1] : 1
				}

				return location.pathname + '/replies?page=' + page
			}
		},

		created () {
			this.fetch()
		}
	}
</script>