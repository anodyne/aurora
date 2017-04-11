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

if (! function_exists('partial')) {
	function partial($file, array $data = [])
	{
		return view("partials.{$file}", $data)->render();
	}
}
