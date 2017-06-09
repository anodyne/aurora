<template>
	<div class="modal docked docked-right" id="notification-panel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Notifications</h5>
					<h5 class="my-0">
						<span class="badge badge-dark">{{ notificationCount }}</span>
					</h5>
				</div>

				<div class="modal-body">
					<div class="notification-container" v-if="loadingNotifications">
						<i class="fa fa-btn fa-spinner fa-spin"></i>Loading Notifications
					</div>

					<div class="notification-container" v-if="!hasNotifications">
						<div class="alert alert-warning mb-0">
							You don't have any notifications right now!
						</div>
					</div>

					<div class="notification-container" v-show="!loadingNotifications">
						<div v-for="notification in notifications">
							<notification :item="notification"></notification>
						</div>
					</div>
				</div>

				<!-- Modal Actions -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" @click.prevent="markAllAsRead" v-show="hasNotifications">Mark All Read</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Notification from './Notification.vue';
	import { EventBus } from '../mixins/EventBus.js';

	export default {
		components: { Notification },

		data () {
			return {
				notifications: [],
				loadingNotifications: false
			}
		},

		computed: {
			hasNotifications() {
				return this.notifications.length > 0;
			},

			notificationCount () {
				return this.notifications.length;
			},

			signedIn () {
				return window.App.signedIn;
			}
		},

		methods: {
			markAllAsRead () {
				let self = this;

				axios.delete('/user/' + window.App.user.username + '/notifications', {
					data: {
						notifications: _.map(self.notifications, 'id')
					}
				}).then(response => {
					self.notifications = [];

					EventBus.$emit('mark-all-notifications-as-read');

					flash('All your notifications have been marked as read.');
				});
			}
		},

		created () {
			if (this.signedIn) {
				let self = this;
				let user = window.App.user;
				let siteUrl = window.App.siteUrl;
			
				axios.get(siteUrl + '/user/' + user.username + '/notifications')
					.then(response => {
						self.notifications = response.data;
						self.loadingNotifications = false;
					});
			}
		}
	}
</script>