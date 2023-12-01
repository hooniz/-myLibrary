<?php

namespace app\controllers;

use app\vendor\Controller;
use app\models\regModel;

class regController extends Controller
{
	public function __construct()
	{
		$this->model = new regModel();
		parent::__construct();
	}

	public function indexAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		self::$view->render('reg', true, $response);
	}

	public function doAction()
	{
		$this->model->doReg();
	}
}