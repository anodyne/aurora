<?php

if (! function_exists('alert')) {
	function alert($level, $message, $header = null, $icon = null)
	{
		return partial('alert', compact('level', 'message', 'header', 'icon'));
	}
}

if (! function_exists('alias')) {
	function alias($key)
	{
		return config("app.aliases.{$key}");
	}
}

if (! function_exists('avatar')) {
	function avatar($user)
	{
		return app('avatar')->setUser($user);
	}
}

// avatar($user)->link()
// avatar($user)->link()->small()
// avatar($user)->default('foo')->image()->large()

if (! function_exists('d')) {
	function d()
	{
		array_map(function ($x) {
			(new Illuminate\Support\Debug\Dumper)->dump($x);
		}, func_get_args());
	}
}

if (! function_exists('modal')) {
	function modal(array $data)
	{
		return partial('modal', [
			'id'		=> (array_key_exists('id', $data)) ? $data['id'] : false,
			'header'	=> (array_key_exists('header', $data)) ? $data['header'] : false,
			'body'		=> (array_key_exists('body', $data)) ? $data['body'] : false,
			'footer'	=> (array_key_exists('footer', $data)) ? $data['footer'] : false,
			'size'		=> (array_key_exists('size', $data)) ? $data['size'] : false,
		]);
	}
}

if (! function_exists('partial')) {
	function partial($file, array $data = [])
	{
		return view("partials.{$file}", $data)->render();
	}
}
