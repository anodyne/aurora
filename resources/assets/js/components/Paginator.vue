<template>
	<div>
		<div class="discussion-offset">
			<ul class="pagination" v-if="shouldPaginate">
				<li class="page-item" v-show="previousPageUrl">
					<a class="page-link" href="#" aria-label="Previous" rel="previous" @click.prevent="page--">
						<span aria-hidden="true">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-chevron-left"></use>
							</svg>
						</span>
						<span class="sr-only">Previous</span>
					</a>
				</li>

				<li :class="pageItemClass(pageNum)" v-for="pageNum in this.dataSet.last_page">
					<a class="page-link" href="#" @click.prevent="page = pageNum">{{ pageNum }}</a>
				</li>

				<li class="page-item" v-show="nextPageUrl">
					<a class="page-link" href="#" aria-label="Next" rel="next" @click.prevent="page++">
						<span aria-hidden="true">
							<svg class="icon">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-chevron-right"></use>
							</svg>
						</span>
						<span class="sr-only">Next</span>
					</a>
				</li>
			</ul>
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
			shouldPaginate () {
				return !! this.previousPageUrl || !! this.nextPageUrl
			}
		},

		methods: {
			broadcast () {
				return this.$emit('changed', this.page)
			},

			pageItemClass (page) {
				if (page == this.page) {
					return 'page-item active'
				}

				return 'page-item'
			},

			updateUrl () {
				history.pushState(null, null, '?page=' + this.page)
			}
		},

		watch: {
			dataSet () {
				this.page = this.dataSet.current_page
				this.previousPageUrl = this.dataSet.prev_page_url
				this.nextPageUrl = this.dataSet.next_page_url
			},

			page () {
				this.broadcast().updateUrl()
			}
		}
	}
</script>