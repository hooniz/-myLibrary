<?php

namespace app\vendor;

class View
{
	public function render(string $view, bool $needTemplate, array $arResult = null)
	{
		$pathModification = self::getPathModification();
		$css = self::getCss($view, $pathModification);
		if($needTemplate)
		{
			require_once "app/views/templates/header.php";
		}
		require_once "app/views/{$view}.php";
		if($needTemplate)
		{
			require_once "app/views/templates/footer.php";
		}
	}

	public static function getPathModification() : string
	{
		$result = "";
		$url = $_SERVER['REQUEST_URI'];
		$modifications = explode('/', $url);
		foreach ($modifications as $modification)
		{
			if($modification != "")
			{
				$result .= "../";
			}
		}
		if($result == "")
		{
			$result = "/";
		}
		return $result;
	}

	public static function getCss(string $view, string $pathModification) : string
	{
		$result = '';
		if(file_exists("styles/{$view}.css"))
		{
			$result = "{$pathModification}styles/{$view}.css?" . time();
		}
		return $result;
	}
}