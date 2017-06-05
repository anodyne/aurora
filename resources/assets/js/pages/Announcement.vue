<template>
	<div v-cloak>
		<div class="row d-flex align-items-center">
			<div class="col-md-9 d-flex align-items-center">
				<p class="lead">{{ announcement.title }}</p>
			</div>
			<div class="col-md-3 controls">
				<div class="btn-toolbar float-right">
					<div class="btn-group">
						<a :href="editUrl" class="btn btn-secondary">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-edit"></use>
							</svg>
						</a>
					</div>
					<div class="btn-group ml-2">
						<a href="#" class="btn btn-outline-danger" @click.prevent="deleteAnnouncement">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-trash"></use>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import moment from 'moment';

	export default {
		props: {
			announcement: {
				type: Object,
				required: true
			}
		},

		computed: {
			editUrl () {
				return window.App.siteUrl + '/admin/announcements/' + this.announcement.id + '/edit';
			}
		},

		methods: {
			deleteTopic () {
				axios.delete('/admin/announcements/' + this.announcement.id);

				flash('Announcement was deleted');
			}
		}
	}
</script>