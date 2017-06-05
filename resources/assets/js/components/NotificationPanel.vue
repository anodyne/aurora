<template>
	<div class="modal docked docked-right" id="notification-panel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button :class="notificationBtnClasses" @click="showNotifications">Notifications</button>
					<button :class="announcementBtnClasses" @click="showAnnouncements">Announcements<span class="badge" v-if="hasAnnouncements">&nbsp;</span></button>
				</div>

				<div class="modal-body">
					<div class="notification-container" v-if="loadingNotifications">
						<i class="fa fa-btn fa-spinner fa-spin"></i>Loading Notifications
					</div>

					<div class="notification-container" v-if="!showingNotifications && !showingAnnouncements">
						<div class="alert alert-warning mb-0">
							We don't have anything to show you right now! But when we do,
							we'll be sure to let you know. Talk to you soon!
						</div>
					</div>

					<div class="notification-container" v-if="showingNotifications && !hasNotifications">
						<div class="alert alert-warning mb-0">
							We don't have any notifications to show you right now! But when we do,
							we'll be sure to let you know. Talk to you soon!
						</div>
					</div>

					<div class="notification-container" v-if="showingAnnouncements && !hasAnnouncements">
						<div class="alert alert-warning mb-0">
							We don't have any announcements to show you right now! But when we do,
							we'll be sure to let you know. Talk to you soon!
						</div>
					</div>

					<div class="notification-container" v-show="showingNotifications">
						<div v-for="notification in notifications">
							<notification :item="notification"></notification>
						</div>
					</div>

					<div class="notification-container" v-show="showingAnnouncements">
						<div v-for="announcement in announcements">
							<notification :item="announcement"></notification>
						</div>
					</div>
				</div>

				<!-- Modal Actions -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" @click.prevent="markAllAsRead" v-show="showingNotifications && hasNotifications">Mark All Read</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Notification from './Notification.vue';

	export default {
		components: { Notification },

		data () {
			return {
				announcements: [],
				notifications: [],
				loadingNotifications: false,
				showingAnnouncements: false,
				showingNotifications: false
			}
		},

		computed: {
			announcementBtnClasses () {
				return ['btn', (this.showingAnnouncements) ? 'btn-primary' : 'btn-secondary'];
			},

			hasNotifications() {
				return this.notifications.length > 0;
			},

			hasAnnouncements() {
				return this.announcements.length > 0;
			},

			notificationBtnClasses () {
				return ['btn', (this.showingNotifications) ? 'btn-primary' : 'btn-secondary'];
			},

			signedIn () {
				return window.App.signedIn;
			}
		},

		methods: {
			markAllAsRead () {
				if (this.showingAnnouncements) {
					//
				}

				if (this.showingNotifications) {
					axios.delete('/user/' + window.App.user.username + '/notifications', {
						data: {
							notifications: _.map(this.notifications, 'id')
						}
					});
				}
			},

			showAnnouncements () {
				this.showingNotifications = false;
				this.showingAnnouncements = true;
			},

			showNotifications () {
				this.showingAnnouncements = false;
				this.showingNotifications = true;
			}
		},

		watch: {
			notifications () {
				if (this.notifications) {
					this.showingNotifications = true
				}
			}
		},

		created () {
			let user = window.App.user;
			let siteUrl = window.App.siteUrl;

			if (user != null) {
				axios.get(siteUrl + '/user/' + user.username + '/notifications')
					.then(response => {
						for (var n = 0; n <= response.data.length; n++) {
							let item = response.data[n];

							if (item != null) {
								if (_.includes(item.type, 'Announcement')) {
									this.announcements.push(item);
								} else {
									this.notifications.push(item);
								}
							}
						}

						if (this.notifications.length > 0) {
							this.showingNotifications = true;
						}

						if (this.notifications.length == 0 && this.announcements.length > 0) {
							this.showingAnnouncements = true;
						}
					});
			}
		}
	}
</script>