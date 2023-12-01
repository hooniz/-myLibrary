<?php

namespace app\models;
use \app\vendor\Model;

class authModel extends Model
{
	public function doAuth()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$errors = [];

		if(!mb_strlen($login) && !mb_strlen($password))
		{
			$errors[] = 'Вы не ввели логин или пароль';
		}
		$sql = "SELECT * FROM `users` WHERE `login` = :login";
		$dbRes = $this->db->execPDO($sql, [$login]);
		$user = $dbRes['data'][0];

		if(!$dbRes['status'])
		{
			$errors[] = 'Упссс... Что-то пошло не так(';
		}

		if(!count($dbRes['data']))
		{
			$errors[] = 'Неправильный логин';
		}

		if(!password_verify($password, $user['password']))
		{
			$errors[] = 'Неправильный пароль';
		}

		if(!count($errors))
		{
			$userParameters = [
				'id' => $user['iduser'],
				'login' => $user['login'],
				'name' => $user['name'],
				'surname' => $user['surname'],
				'lastname' => $user['lastname'],
				'phone' => $user['phone'],
				'permissions' => $user['permission']
			];
			$this->sessions->setSession('USER', $userParameters);
		}

		$result = [
			'status' => !count($errors)?'OK':'FAIL',
			'errors' => $errors
		];
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function logout()
	{
		$this->sessions->killUserSession();
		header('Location: /');
	}
}