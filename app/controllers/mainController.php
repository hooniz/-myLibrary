<?php

namespace app\controllers;

use app\models\mainModel;
use \app\vendor\Controller;

class mainController extends Controller
{
	public function __construct()
	{
		$this->model = new mainModel();
		parent::__construct();
	}

	public function indexAction()
	{
		$response = $this->model->index();
		$response['USER'] = $this->model->setHeaderResults();
		self::$view->render('main', true, $response);
	}

	public function filterAction()
	{
		$response = $this->model->filter();
		$response['USER'] = $this->model->setHeaderResults();
		self::$view->render('main', true, $response);
	}

	public function getBookAction()
	{
		$this->model->getBook();
	}

	public function contactsAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		self::$view->render('contacts', true, $response);
	}
}