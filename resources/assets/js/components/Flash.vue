<template>
	<transition name="fade">
		<div class="alert alert-success alert-flash" role="alert" v-show="show">
			<strong>Success!</strong> {{ body }}
		</div>
	</transition>
</template>

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

	.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
		opacity: 0
	}
</style>

<script>
	export default {
		props: ['message'],

		data () {
			return {
				body: '',
				show: false
			}
		},

		created () {
			if (this.message) {
				this.flash(this.message)
			}

			window.events.$on('flash', message => this.flash(message))
		},

		methods: {
			flash (message) {
				this.body = message
				this.show = true

				this.hide()
			},

			hide () {
				setTimeout(() => {
					this.show = false
				}, 3000)
			}
		}
	}
</script>