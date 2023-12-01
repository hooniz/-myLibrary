<?php

namespace app\vendor\lib;

class sessions
{
	protected array $arSession = [];

	public function __construct()
	{
		session_start();
		$this->checkAccess();
	}

	public function setSession(string $key, array $arParams) : bool
	{
		if(!$arParams)
		{
			return false;
		}

		$_SESSION[$key] = $arParams;
		return true;
	}

	public function getSession(string $key = null) : array
	{
		if(is_null($key))
		{
			return $_SESSION;
		}
		return $_SESSION[$key] ?? [];
	}

	public function doAuth(int $id) : bool
	{
		$_SESSION['USER'] = [
			'id' => $id
		];
		return true;
	}

	public function isAuth() : bool
	{
		if(isset($_SESSION['USER']))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function checkAccess() : void
	{
		if(!$this->isAuth())
		{
			$url = $_SERVER['REQUEST_URI'];
			$pos = strpos($url, "?");
			if($pos !== false)
			{
				$url = substr($url, 0, $pos);
			}
			$routes = require "app/vendor/routes/routes.php";
			if(!$routes[$url]['notAuthAccess'])
			{
				header('Location: /auth/');
			}
		}
	}

	public function killUserSession()
	{
		unset($_SESSION['USER']);
	}
}