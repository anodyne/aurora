<template>
	<button :title="tooltipText" :class="classes" @click.prevent="subscribe">
		<svg :class="iconClasses">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-star"></use>
		</svg>
	</button>
</template>

<script>
	export default {
		props: {
			discussion: {
				type: Object,
				required: true
			},
			size: {
				type: String,
				default: ''
			}
		},

		data () {
			return {
				isSubscribed: false
			}
		},

		computed: {
			classes () {
				return ['btn', 'btn-subscribe', 'js-tooltip-bottom'];
			},

			endpoint () {
				let pieces = [
					window.App.siteUrl,
					'discussions',
					this.discussion.topic.slug,
					this.discussion.id,
					'subscriptions'
				];

				return pieces.join('/')
			},

			iconClasses () {
				return ['icon', this.size, (this.isSubscribed) ? 'text-primary' : 'text-subtle'];
			},

			tooltipText () {
				if (this.isSubscribed) {
					return 'Unsubscribe from this discussion';
				}

				return 'Subscribe to this discussion';
			}
		},

		methods: {
			subscribe () {
				console.log(this.isSubscribed);

				if (! this.isSubscribed) {
					axios.post(this.endpoint);

					this.isSubscribed = true;

					flash('Subscribed to discussion');
				} else {
					axios.delete(this.endpoint);

					this.isSubscribed = false;

					flash('Unsubscribed from discussion');
				}
			}
		},

		created () {
			this.isSubscribed = this.discussion.isSubscribedTo;
		}
	}
</script>

<style lang="scss">
	@import "../../sass/_mixins", "../../sass/_variables";

	.btn-subscribe {
		padding: 1px 6px;

		background: transparent;

		&:hover {
			.text-primary {
				fill: darken($color-primary, 5%);
			}

			.text-subtle {
				fill: $color-subtle-darker;
			}
		}
	}
</style>