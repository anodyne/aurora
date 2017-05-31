<template>
	<div class="dropdown" v-if="notifications.length">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle d-flex align-items-center">
			<svg class="icon">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bell"></use>
			</svg>
		</a>
		<div class="dropdown-menu">
			<a :href="notification.data.link" 
			   class="dropdown-item" 
			   v-for="notification in notifications" 
			   @click="markAsRead(notification)">{{ notification.data.message }}</a>
		</div>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				notifications: false
			}
		},

		methods: {
			markAsRead (notification) {
				let urlSegments = [
					window.App.siteUrl,
					'user',
					window.App.user.username,
					'notifications',
					notification.id
				];

				axios.delete(urlSegments.join('/'));
			}
		},

		created () {
			axios.get(window.App.siteUrl + '/user/' + window.App.user.username + '/notifications')
				.then(response => this.notifications = response.data);
		}
	}
</script>