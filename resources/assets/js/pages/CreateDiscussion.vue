<script>
	import Quill from 'quill';
	import Tribute from 'tributejs';

	export default {
		data () {
			return {
				body: '',
				editor: false,
				tribute: false
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
					],
					keyboard: {
						bindings: {
							enter: {
								key: 'enter',
								handler () {}
							},
						}
					}
				},
				placeholder: "Let us know what's on your mind...",
				theme: 'bubble'
			});

			this.editor.on('text-change', function (delta) {
				self.body = self.editor.container.firstChild.innerHTML;
			});

			axios.get('/api/users').then(response => {
				self.tribute = new Tribute({
					collection: [
						{
							trigger: '@',
							lookup (user) {
								return user.username + user.name;
							},
							fillAttr: 'username',
							menuItemTemplate (item) {
								return item.original.name + ' <small>' + item.original.username + '</small>';
							},
							selectTemplate (item) {
								return '<a href="/user/' + item.original.username + '" class="mention-token">@' + item.original.username + '</a>';
							},
							values: response.data
						}
					]
				});

				self.tribute.attach(self.editor.root);
			});

			/*$(this.editor.root).atwho({
				at: '@',
				data: ['red', 'blue', 'green', 'yellow', 'black', 'white'],
				displayTpl: '<li>${name} <small>${name}</small></li>',
				insertTpl: '@${name}',
				functionOverrides: {
					insert (text) {
						// Get the selection
						let range = self.editor.getSelection();

						// Insert the text
						self.editor.insertText(range.index, text, Quill.sources.USER);

						let fullText = self.editor.root.innerText;
						let fullTextIndex = fullText.lastIndexOf("@", range.index-1);
						let insertFragment = fullText.substring(fullTextIndex, range.index);

						self.editor.root.innerHTML = self.editor.root.innerHTML.replace(insertFragment + text, text);

						console.log(range.index, text.length, self.editor.root.innerText.substring(range.index));
					}
				}
			});*/
		}
	}
</script>