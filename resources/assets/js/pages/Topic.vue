<template>
	<div v-cloak>
		<div class="row d-flex align-items-center">
			<div class="col-md-9 d-flex align-items-center">
				<span class="badge badge-pill" :style="'background-color:' + topic.color">&nbsp;</span>
				<p class="lead pl-2">{{ topic.name }}</p>
			</div>
			<div class="col-md-3 controls">
				<div class="btn-toolbar float-right">
					<div class="btn-group">
						<a href="route('topics.edit', [$child])" class="btn btn-secondary">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-edit"></use>
							</svg>
						</a>
					</div>
					<div class="btn-group ml-2" v-show="isTrashed">
						<a href="#" class="btn btn-outline-success" data-topic="$child->slug" @click.prevent="restore">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-back-in-time"></use>
							</svg>
						</a>
					</div>
					<div class="btn-group ml-2" v-show="!isTrashed">
						<a href="#" class="btn btn-outline-danger" @click.prevent="deleting = true">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-trash"></use>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row" v-show="deleting" v-cloak>
			<div class="col-12 d-flex align-items-center justify-content-start">
				<p class="mr-3"><strong>Which topic should discussions be moved to?</strong></p>
				<select class="form-control" v-model="newTopic">
					<option value="">Pick a topic</option>
					<option v-for="replacement in replacementTopics" :value="replacement.id">{{ replacement.name }}</option>
				</select>
				<span class="ml-auto">
					<button class="btn btn-outline-danger">Delete</button>
					<button class="btn btn-secondary" @click.prevent="deleting = false">Cancel</button>
				</span>
			</div>
		</div>

		<div v-if="hasChildren">
			<div v-for="(child, index) in topic.children" :key="child.id">
				<topic :topic="child" :all-topics="items" @deleted="remove(index)"></topic>
			</div>
		</div>
	</div>
</template>

<script>
	import Topic from './Topic.vue'

	export default {
		props: ['topic', 'allTopics'],

		components: { Topic },

		data () {
			return {
				deleting: false,
				newTopic: ''
			}
		},

		computed: {
			hasChildren () {
				return this.topic.children.length > 0
			},

			isTrashed () {
				return this.topic.deleted_at != null
			},

			replacementTopics () {
				var self = this

				return self.allTopics.filter(function (topic) {
					return topic.name != self.topic.name
				})
			}
		}
	}
</script>

<style lang="scss">
	@import "../../sass/_mixins", "../../sass/_variables";

	.form-control {
		width: auto !important;

		color: $color-dark;
		border-radius: $radius;
	}
</style>