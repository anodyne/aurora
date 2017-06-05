<template>
	<div class="data-table striped bordered">
		<div class="row" v-for="(announcement, index) in items" :key="announcement.id">
			<div class="col-12">
				<announcement :announcement="announcement"></announcement>
			</div>
		</div>
	</div>
</template>

<script>
	import Announcement from './Announcement.vue';
	import collection from '../mixins/collection';

	export default {
		props: ['announcements'],

		components: { Announcement },

		mixins: [collection],

		created () {
			this.items = this.announcements;
		}
	}
</script>