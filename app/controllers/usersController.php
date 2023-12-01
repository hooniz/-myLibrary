<?php

namespace app\controllers;

use app\models\usersModel;
use app\vendor\Controller;

class usersController extends Controller
{
	public function __construct()
	{
		$this->model = new usersModel();
		parent::__construct();
	}

	public function indexAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$response['USERS'] = $this->model->getUsers();
		self::$view->render('users', true, $response);
	}

	public function editAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$response['USERS'] = $this->model->getUser();
		self::$view->render('edituser', true, $response);
	}

	public function editUserAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$this->model->editUser();
		self::$view->render('edituser', true, $response);
	}
}