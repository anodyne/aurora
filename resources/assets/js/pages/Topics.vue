<template>
	<div class="data-table striped bordered">
		<div class="row" v-for="(topic, index) in items" :key="topic.id">
			<div class="col-12">
				<topic :topic="topic" :all-topics="items" @deleted="remove(index)"></topic>
			</div>
		</div>
	</div>
</template>

<script>
	import Topic from './Topic.vue'
	import collection from '../mixins/collection'

	export default {
		props: ['topics'],

		components: { Topic },

		mixins: [collection],created () {
			this.items = this.topics
		}
	}
</script>