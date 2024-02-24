<?php

namespace LanguageModel;

use databaseModel\Database;
use PDO;

class LanguageModel
{
	static public function index()
	{
		$connect = Database::connect();
		$query = "call get_all_languages()";
		$posts = $connect->query($query);
		$result = $posts->fetchAll(PDO::FETCH_ASSOC);

		if (count($result) > 0) {
			return $result;
		} else {
			$result = "aucun language trouve";
		}

		return $result;
	}

	static public function store($language)
	{
		$connect = Database::connect();
		$query = "call create_language(:language)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":language", $language, PDO::PARAM_STR);
		$result = "";
		if ($stmt->execute()) {
			$result = "language created successfully";
		} else {
			$result = "faild creating language";
		}

		return $result;
	}

	static public function delete($id)
	{
		$connect = Database::connect();
		$query = "call delete_language(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$result = '';
		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				$result = "language deleted successfully";
			} else {
				$result = "language with id : {$id} does not exist";
			}
		} else {
			$result = "error deleting language";
		}
		return $result;
	}

	static public function update($id, $language_name)
	{
		$connect = Database::connect();
		$query = "call update_language(:id, :language_name)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":language_name", $language_name, PDO::PARAM_STR);

		$result = '';

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				$result = "language updated successfully";
			} else {
				$result = "language with id : {$id} does not exists";
			}
		} else {
			$result = "error updating language";
		}

		return $result;
	}
}
