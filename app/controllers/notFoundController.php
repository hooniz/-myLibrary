<?php

namespace app\controllers;

class notFoundController extends \app\vendor\Controller
{
	public function index()
	{
		self::$view->render('404', false);
	}
}