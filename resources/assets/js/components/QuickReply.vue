<template>
	<div>
		<hr>

		<div class="media" v-if="signedIn">
			<div class="media-left">
				<span class="hidden-sm-down">
					<avatar type="image" :user="user"></avatar>
				</span>
			</div>
			<div class="media-body">
				<div class="form-group">
					<textarea name="body" 
							  class="form-control" 
							  rows="5"
							  placeholder="Reply to this discussion now..."
							  required
							  v-model="body"></textarea>
				</div>
				<div class="form-group">
					<button type="submit"
						    class="btn btn-primary"
						    @click="addReply">Reply</button>
				</div>
			</div>
		</div>
		
		<p class="lead text-center" v-if="!signedIn">Please log in to participate in this discussion.</p>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				body: ''
			}
		},

		computed: {
			signedIn () {
				return window.App.signedIn
			},

			user () {
				return window.App.user
			}
		},

		methods: {
			addReply () {
				axios.post(location.pathname + '/replies', { body: this.body })
					.then(response => {
						this.body = ''

						this.$emit('created', response.data)

						flash('Your reply has been posted.')
					})
			}
		}
	}
</script>