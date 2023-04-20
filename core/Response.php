<?php

namespace Core;
class Response
{
	public const BAD_REQUEST = 400;
	public const FORBIDDEN = 403;
	public const NOT_FOUND = 404;
	public const NOT_ALLOWED = 405;

	public static function abort ($code = self::NOT_FOUND)
	{
		http_response_code($code);
		require base_path("views/codes/{$code}.view.php");
		die();
	}

	public static function redirect($uri)
	{
		header($uri);
		die();
	}
}