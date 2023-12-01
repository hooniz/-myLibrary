<?php

namespace app\vendor;

class Router
{
	static public function route() : array
	{
		$routes = require_once "app/vendor/routes/routes.php";
		$url = $_SERVER['REQUEST_URI'];
		$pos = strpos($url, "?");
		if($pos !== false)
		{
			$url = substr($url, 0, $pos);
		}
		if($url == '/')
		{
			return [
				'URIParams' => [
					'controller' => 'main',
					'action' => 'index'
				]
			];
		}

		foreach ($routes as $key => $val)
		{
			$pattern = preg_replace_callback("/{([A-Za-z]*)}/", function($matches) use(&$names)
			{
				$names[] = $matches[1];
				return "([0-9A-Za-z-]+)";
			} , $key);

			if(preg_match_all("~^$pattern$~", $url, $matches))
			{
				array_shift($matches);
				$params = [];
				for ($i=0; $i < count($matches); $i++)
				{
					$params[$names[$i]] = $matches[$i][0];
				}
				return [
					'URIParams' => $val,
					'callValues' => $params
				];
			}
		}
		return [];
	}
}