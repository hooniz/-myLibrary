<?php

namespace app\vendor\lib;

class user extends sessions
{
	public function __construct()
	{

	}

	public function isAuth() : bool
	{
		return parent::isAuth();
	}
}