<template>
	<transition name="fade">
		<div :class="classes"
			 role="alert"
			 v-show="show"
			 v-text="body"></div>
	</transition>
</template>

<script>
	export default {
		props: {
			message: {
				type: String,
				required: true
			},
			type: {
				type: String,
				default: 'success'
			}
		},

		data () {
			return {
				body: '',
				level: 'success',
				show: false,
				startTransition: false
			}
		},

		computed: {
			classes () {
				return ['alert', 'alert-flash', 'alert-' + this.level];
			},

			exclamation () {
				switch (this.level) {
					case 'success':
					default:
						return 'Success!';

					case 'warning':
						return 'Warning!';

					case 'danger':
						return 'Failed!';
				}
			}
		},

		methods: {
			flash (data) {
				this.body = data.message;
				this.show = true;
				this.level = data.level;

				this.hide();
			},

			hide () {
				var self = this;

				setTimeout(() => {
					self.startTransition = true;
				}, 3500);
			}
		},

		watch: {
			startTransition (newValue, oldValue) {
				if (newValue) {
					var self = this;

					$('.alert-flash').fadeOut(() => {
						self.show = false;
					});
				}
			}
		},

		created () {
			if (this.message) {
				this.flash(this.message, this.type);
			}

			window.events.$on('flash', data => this.flash(data));
		}
	};
</script>

<style lang="scss">
	.alert-flash {
		position: fixed;
		right: 1rem;
		bottom: 0;
		z-index: 1000;

		box-shadow: 0 3px 9px rgba(0, 0, 0, 0.25);
	}

	.fade-enter-active, .fade-leave-active {
		transition: opacity .5s
	}

	.fade-enter, .fade-leave-to {
		opacity: 0
	}
</style>