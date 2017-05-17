<template>
	<div :id="'reply-' + reply.id" class="media">
		<div class="media-left">
			<span class="hidden-sm-down">
				<avatar :user="reply.author"></avatar>
			</span>
		</div>

		<div class="media-body">
			<div :class="panelClasses">
				<div class="panel-heading hidden-sm-down">
					<h3 class="panel-title mr-auto"><a :href="'/profiles/' + reply.author.username" v-text="reply.author.name"></a></h3>
					<small class="timestamp text-subtle js-tooltip-top" :title="createdAt()">Replied {{ createdAt('relative') }}</small>
				</div>
				<div class="panel-heading hidden-md-up">
					<avatar :user="reply.author" :has-label="true">
						<span slot="beforeLabel" v-cloak>{{ createdAt('relative') }}</span>
					</avatar>
					<div class="dropdown">
						<a href="#" id="dropdownMenuButton" data-toggle="dropdown">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-dots-three-vertical"></use>
							</svg>
						</a>
						
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#" @click.prevent="editing = true" v-if="canUpdate">Edit</a>
							<a class="dropdown-item" href="#" @click.prevent="destroy" v-if="canDelete">Delete</a>
							<div class="dropdown-divider" v-if="canUpdate"></div>
							<a class="dropdown-item" href="#">Mark as Answer</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#" @click.prevent="copyLink">Copy Link</a>
							<a class="dropdown-item" href="#">Message {{ reply.author.name }}</a>
							<a class="dropdown-item" href="#">Report</a>
						</div>
					</div>
				</div>

				<div class="panel-body">
					<div v-if="editing">
						<div class="form-group">
							<textarea class="form-control" rows="10" v-model="body">{{ body }}</textarea>
						</div>

						<div class="btn-toolbar">
							<div class="btn-group">
								<button class="btn btn-primary" @click.prevent="update">Update</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-link-secondary" @click.prevent="editing = false">Cancel</button>
							</div>
						</div>
					</div>

					<div v-else>
						<div v-html="marked(body)"></div>

						<div class="post-signature" v-if="signature">
							<div v-html="marked(signature)"></div>
						</div>
					</div>
				</div>

				<div v-if="signedIn">
					<div class="panel-footer hidden-sm-down">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<favorite :reply="reply"></favorite>
							</div>
							<a href="#" class="btn">
								<svg class="icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-check"></use>
								</svg>
							</a>
						</div>

						<div class="dropdown dropup">
							<a href="#" id="dropdownMenuButton" class="btn" data-toggle="dropdown">
								<svg class="icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-dots-three-vertical"></use>
								</svg>
							</a>
							
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#" @click.prevent="editing = true" v-if="canUpdate">Edit</a>
								<a class="dropdown-item" href="#" @click.prevent="destroy" v-if="canDelete">Delete</a>
								<div class="dropdown-divider" v-if="canUpdate"></div>
								<a class="dropdown-item" href="#" @click.prevent="copyLink">Copy Link</a>
								<a class="dropdown-item" href="#">Message {{ reply.author.name }}</a>
								<a class="dropdown-item" href="#">Report</a>
							</div>
						</div>
					</div>

					<div class="panel-footer hidden-md-up">
						<favorite :reply="reply" v-if="signedIn"></favorite>
						<a href="#" class="btn">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-check"></use>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Favorite from './Favorite.vue'
	import moment from 'moment'
	import copy from 'copy-to-clipboard'

	export default {
		props: ['discussion', 'reply'],

		components: { Favorite },

		data () {
			return {
				body: this.reply.body,
				editing: false,
				signature: this.reply.author.signature
			}
		},

		computed: {
			canCreate () {},
			canDelete () {},
			canUpdate () {
				return this.authorize(user => this.reply.user_id == user.id)
			},

			isAnswer () {
				return this.discussion.answer_id == this.reply.id
			},

			panelClasses () {
				return this.isAnswer ? ['panel', 'panel-success'] : ['panel', 'panel-default']
			},

			signedIn () {
				return window.App.signedIn
			}
		},

		methods: {
			copyLink () {
				copy(window.App.siteUrl + '/discussions/' + this.discussion.topic.slug + '/' + this.discussion.id + '#reply-' + this.reply.id)
			},

			createdAt (format) {
				if (format == 'relative') {
					return moment(this.reply.created_at, 'YYYY-MM-DD hh:mm:ss').fromNow()
				}

				return this.reply.created_at
			},

			destroy () {
				axios.delete('/replies/' + this.reply.id)

				this.$emit('deleted', this.reply.id)
			},

			like () {
				axios.post('/replies/' + this.reply.id + '/favorites')

				flash('Liked the reply')
			},

			update () {
				axios.patch('/replies/' + this.reply.id, {
					body: this.body
				})

				this.editing = false

				flash('Updated the reply.')
			}
		}
	}
</script>