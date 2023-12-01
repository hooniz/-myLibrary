<?php

namespace app\models;

use app\vendor\Model;

class usersModel extends Model
{
	public function getUsers()
	{
		$sql = "SELECT * FROM `users`";
		return $this->db->execPDO($sql);
	}

	public function getUser()
	{
		$id = $_GET['id'];
		$sql = "SELECT * FROM `users` WHERE `iduser` = :id";
		return $this->db->execPDO($sql, [$id]);
	}

	public function editUser()
	{
		$userId = $_POST['userId'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$login = $_POST['login'];
		$role = $_POST['role'];

		$sql = "UPDATE `myLibrary`.`users` SET `name` = :name, `surname` = :surname, `lastname` = :lastname, `phone` = :phone, `login` = :login, `permission` = :role WHERE (`iduser` = :userId);";
		try {
			$result = $this->db->execPDO($sql, [$name, $surname, $lastname, $phone, $login, $role, $userId]);
			if($result)
			{
				$_SESSION['REDIRECT']['MESSAGE_SUCCESS'] = 'Запись успешно обновлена';
			}else
			{
				throw new \Exception();
			}
		}catch (\Exception $exception)
		{
			$_SESSION['REDIRECT']['MESSAGE_ALERT'] = 'Что-то пошло не так';
		}
		header('Location: /users/edit/?id=' . $userId);
	}
}