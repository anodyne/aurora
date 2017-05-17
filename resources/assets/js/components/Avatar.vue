<template>
	<div class="avatar-container" v-cloak>
		<a :href="profileLink" :class="classes" :style="'background-image:url(' + url + ')'" v-if="type == 'link'"></a>
		<div :class="classes" :style="'background-image:url(' + url + ')'" v-if="type != 'link'"></div>

		<div v-if="hasLabel">
			<div class="avatar-label ml-3" v-if="size == 'lg'" v-cloak>
				<span class="h1">{{ this.user.name }}</span>
				<span class="text-muted">
					<slot name="beforeLabel"></slot>
					<span class="px-1" v-if="hasBeforeLabel">&bull;</span>
					<span>{{ points }}</span>
					<span class="px-1" v-if="hasAfterLabel">&bull;</span>
					<slot name="afterLabel"></slot>
				</span>
			</div>

			<div class="avatar-label ml-3" v-if="size == 'md'" v-cloak>
				<span class="h4">{{ this.user.name }}</span>
				<span class="text-muted">
					<slot name="beforeLabel"></slot>
					<span class="px-1" v-if="hasBeforeLabel">&bull;</span>
					<span>{{ points }}</span>
					<span class="px-1" v-if="hasAfterLabel">&bull;</span>
					<slot name="afterLabel"></slot>
				</span>
			</div>

			<div class="avatar-label ml-2" v-if="size == 'sm'">
				<span class="h5 mb-0">{{ this.user.name }}</span>
			</div>

			<div class="avatar-label ml-2" v-if="size == 'xs'">
				<span class="h6 mb-0">{{ this.user.name }}</span>
			</div>

			<div class="avatar-label ml-3" v-if="size == ''" v-cloak>
				<span class="h6 mb-1">{{ this.user.name }}</span>
				<small class="text-muted">
					<slot name="beforeLabel"></slot>
					<span class="px-1" v-if="hasBeforeLabel">&bull;</span>
					<span>{{ points }}</span>
					<span class="px-1" v-if="hasAfterLabel">&bull;</span>
					<slot name="afterLabel"></slot>
				</small>
			</div>
		</div>
	</div>
</template>

<script>
	import md5 from 'md5'
	import pluralize from 'pluralize'
	import humanize from 'humanize-number'

	export default {
		props: {
			hasLabel: {
				type: Boolean,
				default: false
			},
			size: {
				type: String,
				default: ''
			},
			type: {
				type: String,
				default: 'link'
			},
			user: {
				type: Object,
				required: true
			}
		},

		computed: {
			classes () {
				return ['avatar', this.size]
			},

			hasAfterLabel () {
				return this.$slots.afterLabel != null
			},

			hasBeforeLabel () {
				return this.$slots.beforeLabel != null
			},

			points () {
				return humanize(this.user.points) + ' XP'
			},

			profileLink () {
				return window.App.siteUrl + '/user/' + this.user.username
			},

			url () {
				const img = [
					'https://www.gravatar.com/avatar/',
					md5(this.user.email.trim().toLowerCase()),
					'?s=240',
					'&d=retro',
					'&r=pg'
				]

				return img.join('')
			}
		}
	}
</script>