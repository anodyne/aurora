<script>
	export default {
		props: ['attributes'],

		data () {
			return {
				body: this.attributes.body,
				editing: false,
				signature: this.attributes.author.signature
			}
		},

		methods: {
			destroy () {
				axios.delete('/replies/' + this.attributes.id)

				$(this.$el).fadeOut(300, () => {
					flash('Deleted the reply')
				})
			},

			like () {
				axios.post('/replies/' + this.attributes.id + '/favorites')

				flash('Liked the reply')
			},

			update () {
				axios.patch('/replies/' + this.attributes.id, {
					body: this.body
				})

				this.editing = false

				flash('Updated the reply.')
			}
		}
	}
</script>