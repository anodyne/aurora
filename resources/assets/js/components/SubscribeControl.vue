<template>
	<button :class="classes" @click.prevent="subscribe">
		<svg :class="iconClasses">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-star"></use>
		</svg>
	</button>
</template>

<script>
	export default {
		props: ['discussion'],

		data () {
			return {
				isSubscribed: false
			}
		},

		computed: {
			classes () {
				return ['btn', 'btn-subscribe'];
			},

			iconClass () {
				return ['icon', (this.isSubscribed) ? 'text-primary' : 'text-subtle'];
			}
		},

		methods: {
			subscribe () {
				if (this.isSubscribed) {
					axios.post(window.App.siteUrl + location.pathname + '/subscriptions');

					flash('Subscribed to discussion');
				} else {
					axios.delete(window.App.siteUrl + location.pathname + '/subscriptions');

					flash('Unsubscribed from discussion');
				}
			}
		},

		created () {
			this.isSubscribed = discussion.isSubscribedTo;
		}
	}
</script>

<style lang="scss">
	.btn-subscribe {
		background: transparent;
	}
</style>