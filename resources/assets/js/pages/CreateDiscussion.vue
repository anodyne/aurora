<script>
	import Quill from 'quill';

	export default {
		data () {
			return {
				body: '',
				editor: false
			}
		},

		mounted () {
			let self = this;

			this.editor = new Quill('#editor', {
				modules: {
					toolbar: [
						['bold', 'italic', 'underline'],
						['blockquote', 'code-block'],
						['link', 'image'],
						[{ 'header': [2, 3, false] }],
						[{ 'list': 'ordered'}, { 'list': 'bullet' }]
					]
				},
				placeholder: "Let us know what's on your mind...",
				theme: 'bubble'
			});

			this.editor.on('text-change', function (delta) {
				self.body = self.editor.container.firstChild.innerHTML;
			});
		}
	}
</script>