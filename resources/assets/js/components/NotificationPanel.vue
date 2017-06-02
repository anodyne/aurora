<template>
	<div class="modal docked docked-right" id="notification-panel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="btn btn-secondary" :class="{'active': showingNotifications}" @click="showNotifications">Notifications</button>
					<button class="btn btn-secondary" :class="{'active': showingAnnouncements}" @click="showAnnouncements">Announcements</button>
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

					<div class="notification-container" v-show="showingNotifications">
						<div v-for="notification in notifications">
							<notification :item="notification"></notification>
						</div>
					</div>

					<div class="notification-container" v-show="showingAnnouncements"></div>
				</div>

				<!-- Modal Actions -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary">Mark All Read</button>
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
				announcements: false,
				notifications: false,
				loadingNotifications: false,
				showingAnnouncements: false,
				showingNotifications: false
			}
		},

		computed: {
			hasNotifications() {
				return this.notifications && this.notifications.length > 0;
			},

			hasAnnouncements() {
				return this.announcements && this.announcements.length > 0;
			},

			signedIn () {
				return window.App.signedIn;
			}
		},

		methods: {
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
			// Get the notifications
			// Get the announcements

			if (window.App.user != null) {
				axios.get(window.App.siteUrl + '/user/' + window.App.user.username + '/notifications')
					.then(response => this.notifications = response.data);
			}
		}
	}
</script>