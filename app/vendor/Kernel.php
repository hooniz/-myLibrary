<?php

namespace app\vendor;

class Kernel
{
	static public function init()
	{
		$callValues = Router::route();
		if(!$callValues)
		{
			self::prepareCallValues(true);
		}
		if(isset($callValues['callValues']))
		{
			self::prepareCallValues(false, $callValues['URIParams'], $callValues['callValues']);
		}else
		{
			self::prepareCallValues(false, $callValues['URIParams']);
		}
	}

	static public function prepareCallValues( bool $is404, ?array $val = null, ?array $params = null) : void
	{
		$actionName = null;
		$modelName = null;
		$controllerExist = file_exists("app/controllers/{$val['controller']}Controller.php");
		$modelExist = file_exists("app/models/{$val['controller']}Model.php");

		if($is404 OR !$controllerExist)
		{
			$message = 'Error - Route wasnt found';
			if(!$controllerExist)
			{
				$message = 'Error - Controller does not exist';
			}
			logWrite($message, "coreErrors");
			self::notFound();
		}else
		{
			$controllerName = "{$val['controller']}Controller";
			$modelName = null;

			$actionName = "{$val['action']}Action";
			if(!$modelExist)
			{
				$message = 'Warning -- Model does not exist';
				logWrite($message, "coreErrors");
			}else
			{
				$modelName = "{$val['controller']}Model";
			}
			self::controllerCall($controllerName, $modelName, $actionName, $params);
		}
	}

	static public function controllerCall(string $controllerName, ?string $modelName, ?string $actionName, ?array $params)
	{
		require_once "app/controllers/{$controllerName}.php";
		if(!is_null($modelName))
		{
			require_once "app/models/{$modelName}.php";
		}
		$namespace = '\app\controllers\\' . $controllerName;
		$controller = new $namespace();

		if(method_exists($controller, $actionName))
		{
			$controller->$actionName($params);
		}else
		{
			$message = "Action does not exist";
			logWrite($message, "coreErrors");
			self::notFound();
		}
	}

	public static function notFound()
	{
		require_once "app/controllers/notFoundController.php";
		$controller = new \app\controllers\notFoundController();
		$controller->index();
	}
}