<?php

namespace app\vendor;

class Controller
{
	static public View $view;
	public $model;

	public function __construct()
	{
		self::$view = new View();
	}
}