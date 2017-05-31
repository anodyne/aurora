<template>
	<div>
		<div class="discussion-offset">
			<div class="pagination" v-if="shouldPaginate">
				<div :class="previousPageClasses">
					<a class="page-link" href="#" aria-label="Previous" rel="previous" @click.prevent="previousPage()">
						<span aria-hidden="true">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-chevron-left"></use>
							</svg>
						</span>
						<span class="sr-only">Previous</span>
					</a>
				</div>

				<div :class="pageItemClass(pageNum)" v-for="pageNum in this.dataSet.last_page">
					<a class="page-link" href="#" @click.prevent="page = pageNum">{{ pageNum }}</a>
				</div>

				<div :class="nextPageClasses">
					<a class="page-link" href="#" aria-label="Next" rel="next" @click.prevent="nextPage()">
						<span aria-hidden="true">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-chevron-right"></use>
							</svg>
						</span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['dataSet'],

		data () {
			return {
				page: 1,
				previousPageUrl: false,
				nextPageUrl: false
			}
		},

		computed: {
			nextPageClasses () {
				return ['page-item', (nextPageUrl) ? '' : 'disabled'];
			},

			previousPageClasses () {
				return ['page-item', (previousPageUrl) ? '' : 'disabled'];
			},

			shouldPaginate () {
				return !! this.previousPageUrl || !! this.nextPageUrl;
			}
		},

		methods: {
			broadcast () {
				return this.$emit('changed', this.page);
			},

			nextPage () {
				if (this.nextPageUrl) {
					this.page++;
				}
			},

			pageItemClass (page) {
				return ['page-item', (page == this.page) ? 'active' : ''];
			},

			previousPage () {
				if (this.previousPageUrl) {
					this.page--;
				}
			},

			updateUrl () {
				history.pushState(null, null, '?page=' + this.page);
			}
		},

		watch: {
			dataSet () {
				this.page = this.dataSet.current_page;
				this.previousPageUrl = this.dataSet.prev_page_url;
				this.nextPageUrl = this.dataSet.next_page_url;
			},

			page () {
				this.broadcast().updateUrl();
			}
		}
	}
</script>