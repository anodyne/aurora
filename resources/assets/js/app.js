/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var marked = require('marked');
var moment = require('moment-timezone');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.prototype.authorize = function (handler) {
	let user = window.App.user;
	let admin = user.roles.find(role => role.name == 'Forums Administrator');
	let moderator = user.roles.find(role => role.name == 'Forums Moderator');

	if (admin || moderator) {
		return true;
	}

	return user ? handler(user) : false;
}

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('avatar', require('./components/Avatar.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('topics', require('./pages/Topics.vue'));
Vue.component('paginator', require('./components/Paginator.vue'));
Vue.component('discussion-view', require('./pages/Discussion.vue'));
Vue.component('create-discussion', require('./pages/CreateDiscussion.vue'));
Vue.component('subscribe-control', require('./components/SubscribeControl.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('notification-panel', require('./components/NotificationPanel.vue'));
Vue.component('user-notifications', require('./components/UserNotifications.vue'));

Vue.mixin({
	methods: {
		formatDate: function (date, format) {
			var dateFormat = 'YYYY-MM-DD hh:mm:ss';
			var timezone = window.App.timezone;

			if (format == 'relative') {
				return moment(date, dateFormat).tz(timezone).fromNow();
			}

			return moment(date, dateFormat).tz(timezone).format('LLL');
		},

		marked: function (input) {
			return marked(input);
		}
	}
});
