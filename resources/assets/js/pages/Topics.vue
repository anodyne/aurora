<template>
	<div class="data-table striped bordered">
		<div class="row" v-for="(topic, index) in items" :key="topic.item.id">
			<div class="col-12">
				<topic :topic="topic.item" 
					   :all-topics="dataSet" 
					   :is-child="topic.isChild"></topic>
			</div>
		</div>
	</div>
</template>

<script>
	import Topic from './Topic.vue';
	import collection from '../mixins/collection';

	export default {
		props: ['topics'],

		components: { Topic },

		mixins: [collection],

		data () {
			return {
				dataSet: []
			}
		},

		methods: {
			extract (topic, isParent) {
				var item = {
					item: topic,
					hasChildren: false,
					isChild: false
				};

				if (isParent && topic.children && topic.children.length > 0) {
					item.hasChildren = true;
				}

				if (! isParent) {
					item.isChild = true;
				}

				return item;
			}
		},

		created () {
			for (var t = 0; t < this.topics.length; t++) {
				var topic = this.extract(this.topics[t], true);

				this.dataSet.push(topic);

				if (topic.hasChildren) {
					for (var c = 0; c < topic.item.children.length; c++) {
						this.dataSet.push(this.extract(topic.item.children[c], false));
					}
				}
			}

			this.items = this.dataSet;
		}
	}
</script>