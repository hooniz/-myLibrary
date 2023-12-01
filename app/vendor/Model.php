<?php

namespace app\vendor;

use app\vendor\lib\db,
	app\vendor\lib\sessions,
	app\vendor\lib\user;

class Model
{
	protected db $db;
	protected sessions $sessions;
	protected user $user;

	protected $headerResults;

	public function __construct()
	{
		$this->setProps();
	}

	final public function setProps()
	{
		require_once "app/vendor/lib/db.php";
		require_once "app/vendor/lib/sessions.php";
		require_once "app/vendor/lib/user.php";
		require_once "app/vendor/lib/validate.php";
		$this->db = db::getInstance();
		$this->db->setPDO();
		$this->sessions = new sessions();
		$this->user = new user();

		$this->headerResults = $this->setHeaderResults();
	}

	public function setHeaderResults()
	{
		$arResult = [];
		$isAuth = $this->user->isAuth();
		if($isAuth)
		{
			$arResult = $this->sessions->getSession('USER');
		}
		$arResult['AUTH'] = $isAuth;
		return $arResult;
	}
}