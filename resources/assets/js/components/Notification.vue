<template>
	<div>
		<!-- DiscussionWasUpdated notification -->
		<div class="notification" v-if="type == 'App.Notifications.DiscussionWasUpdated'">
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
				<div class="meta">
					<p class="title" v-text="item.data.author.name"></p>

					<div class="date">
						{{ formatDate(item.created_at, 'relative') }}
					</div>
				</div>

				<div class="notification-body" v-html="item.data.message"></div>

				<a :href="item.data.link" class="btn btn-outline-dark">See the reply</a>
			</div>
		</div>

		<!-- ItemWasFavorited notification -->
		<div class="notification" v-if="type == 'App.Notifications.ItemWasFavorited'">
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
				<div class="meta">
					<p class="title" v-text="item.data.author.name"></p>

					<div class="date">
						{{ formatDate(item.created_at, 'relative') }}
					</div>
				</div>

				<div class="notification-body" v-html="item.data.message"></div>

				<a :href="item.data.link" class="btn btn-outline-dark">{{ item.data.linkText }}</a>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['item'],

		computed: {
			type () {
				return this.item.type.replace(/\\/g, ".")
			}
		},

		methods: {
			markAsRead (notification) {
				axios.delete('/user/' + window.App.user.username + '/notifications/' + item.id);
			}
		}
	}
</script>