<?php

if ( ! function_exists('alias')) {
	function alias($key) {
		return config("app.aliases.{$key}");
	}
}
