<?php

namespace app\models;
use \app\vendor\Model;

class mainModel extends Model
{
	public function index() : array
	{
		$sql = "SELECT `books`.`preview`, `books`.`idbook`, `books`.`name` as 'bookname', `books`.`preview_picture`, `books`.`year`, `books`.`pagesCount`, `books`.`rating`, `authors`.* , `langs`.`name` as 'lang', `publishers`.`name` as 'publisher', `address`.*, `readings`.`dateEnd`, `readings`.`users_id` as 'userId' FROM `books` LEFT JOIN `authors` ON `books`.`authors_id` = `authors`.`idauthor` LEFT JOIN `langs` ON `books`.`langs_id` = `langs`.`idlang` LEFT JOIN `publishers` ON `books`.`publishers_id` = `publishers`.`idpublisher` LEFT JOIN `address` ON `publishers`.`address_id` = `address`.`idaddress` LEFT JOIN `readings` ON `books`.`idbook` = `readings`.`books_id` AND CURDATE() <= `readings`.`dateEnd`";
		$response = $this->db->execPDO($sql);
		$response['smartFilter'] = $this->getSmartFilterParameters();
		if($response['status'])
		{
			return $response;
		}
		return [
			'status' => false
		];
	}

	public function getSmartFilterParameters()
	{
		$response = [];
		$sql = "SELECT * FROM `authors`";
		$response['authors'] = $this->db->execPDO($sql)['data'];
		$sql = "SELECT * FROM `publishers`";
		$response['publishers'] = $this->db->execPDO($sql)['data'];
		return $response;
	}

	public function filter()
	{
		$paramsArray = [];
		$sql = "SELECT `books`.`preview`, `books`.`idbook`, `books`.`name` as 'bookname', `books`.`preview_picture`, `books`.`year`, `books`.`pagesCount`, `books`.`rating`, `books`.`publishers_id`, `books`.`authors_id`, `authors`.* , `langs`.`name` as 'lang', `publishers`.`name` as 'publisher', `address`.*, `readings`.`dateEnd`, `readings`.`users_id` as 'userId' FROM `books` LEFT JOIN `authors` ON `books`.`authors_id` = `authors`.`idauthor` LEFT JOIN `langs` ON `books`.`langs_id` = `langs`.`idlang` LEFT JOIN `publishers` ON `books`.`publishers_id` = `publishers`.`idpublisher` LEFT JOIN `address` ON `publishers`.`address_id` = `address`.`idaddress` LEFT JOIN `readings` ON `books`.`idbook` = `readings`.`books_id` AND CURDATE() <= `readings`.`dateEnd` WHERE ";
		$year = $_GET['year'];
		$publisherId = $_GET['publisher_id'];
		$authorId = $_GET['author_id'];
		$rating = $_GET['rating'];
		if($year)
		{
			$sql .= "`year` = :year AND ";
			$paramsArray[] = $year;
		}
		if($publisherId > 0)
		{
			$sql .= "`publishers_id` = :publishers_id AND ";
			$paramsArray[] = $publisherId;
		}
		if($authorId > 0)
		{
			$sql .= "`authors_id` = :authors_id AND ";
			$paramsArray[] = $authorId;
		}
		if($rating)
		{
			$sql .= "`rating` > :rating AND ";
			$paramsArray[] = $rating;
		}
		$sql = trim($sql, " AND");
		$response = $this->db->execPDO($sql, $paramsArray);
		$response['smartFilter'] = $this->getSmartFilterParameters();
		return $response;
	}

	public function getBook()
	{
		$response = [];
		$book_id = $_POST['book_id'];
		if(isset($this->sessions->getSession('USER')['id']))
		{
			$user_id = $this->sessions->getSession('USER')['id'];
		}else
		{
			$user_id = false;
		}
		if(!$user_id)
		{
			$response['status'] = 'REDIRECT';
			echo json_encode($response, JSON_UNESCAPED_UNICODE);
			die();
		}
		try {
			$dateStart = date('Y-m-d');
			$dateEnd = date('Y-m-d', strtotime($dateStart . ' + 14 days'));
			$sql = "INSERT INTO `readings`(`dateStart`, `dateEnd`, `users_id`, `books_id`) VALUES (:dateStart, :dateEnd, :user, :book)";
			$this->db->execPDO($sql, [$dateStart, $dateEnd, $user_id, $book_id]);
			$response['status'] = 'OK';
			$response['dateEnd'] = $dateEnd;
			echo json_encode($response, JSON_UNESCAPED_UNICODE);
		}catch (\Exception $e)
		{
			$response['status'] = 'FAIL';
			echo json_encode($response, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}