<?php

if (! function_exists('alias')) {
	function alias($key)
	{
		return config("app.aliases.{$key}");
	}
}

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
