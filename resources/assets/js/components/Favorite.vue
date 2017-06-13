<template>
	<button type="submit" :class="classes" @click="toggle">
		<svg class="icon">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-thumbs-up"></use>
		</svg>
		<span class="pl-2" v-text="count"></span>
	</button>
</template>

<script>
	export default {
		props: ['reply'],

		data () {
			return {
				count: this.reply.favoritesCount,
				active: this.reply.isFavorited
			}
		},

		computed: {
			classes () {
				return ['btn', 'd-flex', 'align-items-center', this.active ? 'btn-liked' : ''];
			},

			endpoint () {
				return window.App.siteUrl + '/replies/' + this.reply.id + '/favorites';
			}
		},

		methods: {
			create () {
				axios.post(this.endpoint);

				this.active = true;
				this.count++;
			},

			destroy () {
				axios.delete(this.endpoint);

				this.active = false;
				this.count--;
			},

			toggle () {
				return this.active ? this.destroy() : this.create();
			}
		}
	};
</script>