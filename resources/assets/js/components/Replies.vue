<template>
	<div>
		<div v-for="(reply, index) in items" :key="reply.id">
			<reply :discussion="discussion" :reply="reply" @deleted="remove(index)"></reply>
		</div>

		<paginator :data-set="dataSet" @changed="fetch"></paginator>

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

		<quick-reply @created="add"></quick-reply>
	</div>
</template>

<script>
	import Reply from './Reply.vue'
	import QuickReply from './QuickReply.vue'
	import collection from '../mixins/collection'

	export default {
		props: ['discussion'],

		components: { Reply, QuickReply },

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