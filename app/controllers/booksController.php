<?php

namespace app\controllers;

use app\vendor\Controller;
use app\models\booksModel;

class booksController extends Controller
{
	public function __construct()
	{
		$this->model = new booksModel();
		parent::__construct();
	}

	public function indexAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$response['BOOKS'] = $this->model->getBooks();
		self::$view->render('books', true, $response);
	}

	public function editAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$response['BOOK'] = $this->model->getBook();
		$response['AUTHORS'] = $this->model->getAuthors();
		$response['PUBLISHERS'] = $this->model->getPublishers();
		$response['LANGS'] = $this->model->getLangs();
		self::$view->render('editbook', true, $response);
	}

	public function editBookAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$this->model->editBook();
		self::$view->render('editbook', true, $response);
	}

	public function getMyBooksAction()
	{
		$response['USER'] = $this->model->setHeaderResults();
		$response['BOOKS'] = $this->model->getMyBooks();
		self::$view->render('mybooks', true, $response);
	}
}