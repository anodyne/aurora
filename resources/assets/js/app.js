/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
var marked = require('marked')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'))
Vue.component('avatar', require('./components/Avatar.vue'))
Vue.component('favorite', require('./components/Favorite.vue'))
Vue.component('discussion-view', require('./pages/Discussion.vue'))

Vue.mixin({
	methods: {
		marked: function (input) {
			return marked(input)
		}
	}
})
