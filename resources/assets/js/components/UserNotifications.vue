<template>
	<a href="#" class="js-notifications" @click.prevent="openNotificationsPanel" v-if="signedIn">
		<div class="unread" v-show="hasUnreadNotifications"></div>
		<svg class="icon">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bell"></use>
		</svg>
	</a>
</template>

<script>
	import { EventBus } from '../mixins/EventBus.js';

	export default {
		props: ['initialNotificationsCount'],

		data () {
			return {
				count: 0
			}
		},

		computed: {
			hasUnreadNotifications () {
				return this.count > 0;
			},

			signedIn () {
				return window.App.user != null;
			}
		},

		methods: {
			markAllAsRead () {
				this.count = 0;
			},

			openNotificationsPanel () {
				$('#notification-panel').modal('show');
			}
		},

		created () {
			this.count = this.initialNotificationsCount;
		},

		mounted () {
			let self = this;

			EventBus.$on('mark-notification-as-read', item => {
				self.count--;
			});

			EventBus.$on('mark-all-notifications-as-read', () => {
				self.count = 0;
			});
		}
	};
</script>