<?php

namespace app\controllers;

use app\models\publishersModel;
use app\vendor\Controller;

class publishersController extends Controller
{
	public function __construct()
	{
		$this->model = new publishersModel();
		parent::__construct();
	}

	public function indexAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$response['PUBLISHERS'] = $this->model->getPublishers();
		self::$view->render('publishers', true, $response);
	}
}