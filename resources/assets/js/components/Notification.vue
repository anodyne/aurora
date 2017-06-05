<template>
	<div>
		<!-- DiscussionWasUpdated notification -->
		<div class="notification" v-if="type == 'App.Notifications.DiscussionWasUpdated'">
			<figure class="d-flex mr-3">
				<avatar :user="item.data.author" size="sm"></avatar>
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

		<!-- DiscussionWasAnswered notification -->
		<div class="notification" v-if="type == 'App.Notifications.DiscussionWasAnswered'">
			<figure class="d-flex mr-3">
				<avatar :user="item.data.author" size="sm"></avatar>
			</figure>

			<div class="notification-content">
				<div class="meta">
					<p class="title" v-text="item.data.author.name"></p>

					<div class="date">
						{{ formatDate(item.created_at, 'relative') }}
					</div>
				</div>

				<div class="notification-body" v-html="item.data.message"></div>

				<a :href="item.data.link" class="btn btn-outline-dark">See the answer</a>
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
		}
	}
</script>