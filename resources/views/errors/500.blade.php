<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Anodyne Productions">
		<meta name="description" content="Anodyne Productions specializes in RPG management software and tools to help game masters play and run their games with powerful and easy-to-use software.">

		<title>Internal Error &bull; Anodyne Forums</title>
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v1') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon.png') }}">

		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/errors.css') }}" rel="stylesheet">
	</head>
	<body>
		<div class="container error">
			<h1>Internal Error</h1>
			@icon('warning')
			<p>Sorry about that, but you don't have permission to access this page.</p>

			<a href="#" class="btn btn-lg btn-outline-danger">Previous Page</a>
		</div>
	</body>
</html>