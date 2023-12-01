<?php

namespace app\models;

use \app\vendor\lib\validate;
use app\vendor\Model;

class regModel extends Model
{
	public function doReg()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$repeatPasword = $_POST['passwordRepeat'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$street  = $_POST['street'];
		$building = $_POST['building'];
		$apartments = $_POST['apartments'];

		$errors = [];
		if($password != $repeatPasword)
		{
			$errors[] = "Пароли не совпадают.";
		}

		if(!validate::loginValidate($login))
		{
			$errors[] = "Слишком короткий логин(от 3 символов)";
		}

		if(!validate::passwordValidate($password))
		{
			$errors[] = "Слишком простой пароль";
		}

		if(!validate::phoneValidate($phone))
		{
			$errors[] = "Некорректный номер телефона";
		}

		if(!validate::nameValidate($name))
		{
			$errors[] = "Неккоректное имя";
		}

		if(!validate::nameValidate($surname))
		{
			$errors[] = "Неккоректное фамилия";
		}

		if(!validate::nameValidate($lastname))
		{
			$errors[] = "Неккоректное отчество";
		}

		if(!mb_strlen($street) || !mb_strlen($building))
		{
			$errors[] = "Вы не ввели адрес";
		}

		if(count($errors))
		{
			$result = [
				'status' => 'FAIL',
				'errors' => $errors
			];
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
			die();
		}

		$addressId = $this->getAddressId($street, $building, $apartments);
		if(!$addressId)
		{
			$addressId = $this->createAddress($street, $building, $apartments);
		}

		$password = password_hash($password, PASSWORD_BCRYPT);
		$sql = "INSERT INTO `users` (`name`, `surname`, `lastname`, `phone`, `login`, `password`, `address_id`) VALUES (:name, :surname, :lastname, :phone, :login, :password, :address_id);";
		try {
			$result = $this->db->execPDO($sql, [$name, $surname, $lastname, $phone, $login, $password, $addressId]);
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
			die();
		}catch (\Exception $e)
		{
			if($e->getCode() == '23000')
			{
				$result = [
					'status' => 'FAIL',
					'errors' => [
						'Такой логин или номер телефона уже используется!'
					]
				];
			}
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
			die();
		}
	}

	public function getAddressId(string $street, string $building, $apartments)
	{
		if($apartments == "")
		{
			return $this->getAddressIdWithoutApartments($street, $building)['data'][0]['idaddress'];
		}
		return $this->getAddressWithApartments($street, $building, $apartments)['data'][0]['idaddress'];
	}

	public function getAddressWithApartments(string $street, string $building, $apartments)
	{
		$sql = "SELECT idaddress FROM `address` WHERE `street` = :street AND `building` = :building AND `apartments` = :apartments";
		return $this->db->execPDO($sql, [$street, $building, $apartments]);
	}

	public function getAddressIdWithoutApartments(string $street, string $building)
	{
		$sql = "SELECT idaddress FROM `address` WHERE `street` = :street AND `building` = :building AND `apartments` IS NULL";
		return $this->db->execPDO($sql, [$street, $building]);
	}

	public function createAddress(string $street, string $building, string $apartments)
	{
		if($apartments == "")
		{
			$sql = "INSERT INTO `myLibrary`.`address` (`street`, `building`) VALUES (:street, :building);";
			return $this->db->execPDO($sql, [$street, $building])['id'];
		}
		$sql = "INSERT INTO `myLibrary`.`address` (`street`, `building`, `apartments`) VALUES (:street, :building, :apartments);";
		return $this->db->execPDO($sql, [$street, $building, $apartments])['id'];
	}
}