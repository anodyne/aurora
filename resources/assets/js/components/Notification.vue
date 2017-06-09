<template>
	<div>
		<!-- DiscussionWasUpdated notification -->
		<a :href="item.data.link"
		   class="notification"
		   v-if="type == 'App.Notifications.DiscussionWasUpdated'"
		   @click="markAsRead">
			<figure class="d-flex mr-3">
				<!--<avatar :user="item.data.author" size="sm"></avatar>
				<div class="type-icon reply"></div>-->
				<div class="notification-type reply">
					<svg class="icon">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-reply"></use>
					</svg>
				</div>
			</figure>

			<div class="notification-content">
				<div class="notification-body" v-html="item.data.message"></div>

				<div class="meta">
					<div class="date">
						{{ formatDate(item.created_at, 'relative') }}
					</div>
				</div>
			</div>
		</a>

		<!-- ItemWasFavorited notification -->
		<a :href="item.data.link"
		   class="notification"
		   v-if="type == 'App.Notifications.ItemWasFavorited'"
		   @click="markAsRead">
			<figure class="d-flex mr-3">
				<!--<avatar :user="item.data.author" size="sm"></avatar>
				<div class="type-icon favorite"></div>-->
				<div class="notification-type favorite">
					<svg class="icon">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-thumbs-up"></use>
					</svg>
				</div>
			</figure>

			<div class="notification-content">
				<div class="notification-body" v-html="item.data.message"></div>

				<div class="meta">
					<div class="date">
						{{ formatDate(item.created_at, 'relative') }}
					</div>
				</div>
			</div>
		</a>
	</div>
</template>

<script>
	import { EventBus } from '../mixins/EventBus.js';

	export default {
		props: ['item'],

		computed: {
			type () {
				return this.item.type.replace(/\\/g, ".")
			}
		},

		methods: {
			markAsRead (notification) {
				axios.delete('/user/' + window.App.user.username + '/notifications/' + this.item.id);

				EventBus.$emit('mark-notification-as-read', this.item.id);
			}
		}
	}
</script>