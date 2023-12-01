<?php

namespace app\models;

use app\vendor\Model;

class publishersModel extends Model
{
	public function getPublishers()
	{
		$sql = "SELECT * FROM `publishers` JOIN `address` ON `publishers`.`address_id` = `address`.`idaddress`;";
		return $this->db->execPDO($sql);
	}
}