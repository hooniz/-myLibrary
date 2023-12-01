<?php

namespace app\models;

use app\vendor\Model;

class booksModel extends Model
{
	public function getBooks()
	{
		$sql = "SELECT `books`.`preview`, `books`.`idbook`, `books`.`name` as 'bookname', `books`.`preview_picture`, `books`.`year`, `books`.`pagesCount`, `books`.`rating`, `authors`.* , `langs`.`name` as 'lang', `publishers`.`name` as 'publisher', `address`.*, `readings`.`dateEnd`, `readings`.`users_id` as 'userId' FROM `books` LEFT JOIN `authors` ON `books`.`authors_id` = `authors`.`idauthor` LEFT JOIN `langs` ON `books`.`langs_id` = `langs`.`idlang` LEFT JOIN `publishers` ON `books`.`publishers_id` = `publishers`.`idpublisher` LEFT JOIN `address` ON `publishers`.`address_id` = `address`.`idaddress` LEFT JOIN `readings` ON `books`.`idbook` = `readings`.`books_id` AND CURDATE() <= `readings`.`dateEnd`";
		$result = $this->db->execPDO($sql);
		return $result;
	}

	public function getBook()
	{
		$bookId = $_GET['id'];
		if(!$bookId)
		{
			header('Location: /books/');
		}
		$sql = "SELECT `books`.`preview`, `books`.`idbook`, `books`.`name` as 'bookname', `books`.`preview_picture`, `books`.`year`, `books`.`pagesCount`, `books`.`rating`, `authors`.* , `langs`.`name` as 'lang', `langs`.`idlang`, `publishers`.`name` as 'publisher', `publishers`.`idpublisher`  FROM myLibrary.books JOIN `publishers` ON `books`.`publishers_id` = `publishers`.`idpublisher` JOIN `authors` ON `books`.`authors_id` = `authors`.`idauthor` JOIN `langs` ON `books`.`langs_id` = `langs`.`idlang` WHERE `books`.`idbook` = :id;";
		return $this->db->execPDO($sql, [$bookId]);
	}

	public function getAuthors()
	{
		$sql = "SELECT * FROM `authors`";
		return $this->db->execPDO($sql);
	}

	public function getPublishers()
	{
		$sql = "SELECT * FROM `publishers`";
		return $this->db->execPDO($sql);
	}

	public function getLangs()
	{
		$sql = "SELECT * FROM `langs`";
		return $this->db->execPDO($sql);
	}

	public function editBook()
	{
		$bookName = $_POST['bookName'];
		$bookId = $_POST['bookId'];
		$year = $_POST['year'];
		$pagesCount = $_POST['pagesCount'];
		$rating = $_POST['rating'];
		$publisher = $_POST['publisher'];
		$author = $_POST['author'];
		$lang = $_POST['lang'];

		$sql = "UPDATE `myLibrary`.`books` SET `name` = :bookName, `year` = :year, `pagesCount` = :pagesCount, `rating` = :rating, `publishers_id` = :publisher, `authors_id` = :author, `langs_id` = :lang WHERE (`idbook` = :bookId);";
		try {
			$result = $this->db->execPDO($sql, [$bookName, $year, $pagesCount, $rating, $publisher, $author, $lang, $bookId]);
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
		header('Location: /books/edit/?id=' . $bookId);
	}

	public function getMyBooks()
	{
		$userId = $this->sessions->getSession('USER')['id'];

		$sql = "SELECT `books`.`preview`, `books`.`idbook`, `books`.`name` as 'bookname', `books`.`preview_picture`, `books`.`year`, `books`.`pagesCount`, `books`.`rating`, `authors`.* , `langs`.`name` as 'lang', `publishers`.`name` as 'publisher', `address`.*, `readings`.`dateEnd`, `readings`.`users_id` as 'userId' FROM `books` LEFT JOIN `authors` ON `books`.`authors_id` = `authors`.`idauthor` LEFT JOIN `langs` ON `books`.`langs_id` = `langs`.`idlang` LEFT JOIN `publishers` ON `books`.`publishers_id` = `publishers`.`idpublisher` LEFT JOIN `address` ON `publishers`.`address_id` = `address`.`idaddress` LEFT JOIN `readings` ON `books`.`idbook` = `readings`.`books_id` AND CURDATE() <= `readings`.`dateEnd` WHERE `readings`.`dateEnd` IS NOT NULL AND `readings`.`users_id` = :userId;";
		return $this->db->execPDO($sql, [$userId]);
	}
}