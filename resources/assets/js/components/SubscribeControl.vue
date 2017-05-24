<template>
	<div>
		<div class="discussion-summary">
			<svg :class="iconClass">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bell"></use>
			</svg>
			<label>
				<input type="checkbox" v-model="isSubscribed" @click="subscribe"> Notify me when there are replies to this discussion
			</label>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['initialIsSubscribed'],

		data () {
			return {
				isSubscribed: false
			}
		},

		computed: {
			iconClass () {
				if (this.isSubscribed) {
					return ['icon', 'text-primary']
				}

				return ['icon', 'text-subtle']
			}
		},

		methods: {
			subscribe () {
				if (this.isSubscribed) {
					axios.post(window.App.siteUrl + location.pathname + '/subscriptions')

					flash('Subscribed to discussion')
				} else {
					axios.delete(window.App.siteUrl + location.pathname + '/subscriptions')

					flash('Unsubscribed from discussion')
				}
			}
		},

		created () {
			this.isSubscribed = this.initialIsSubscribed
		}
	}
</script>