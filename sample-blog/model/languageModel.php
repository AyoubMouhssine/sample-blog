<?php

namespace LanguageModel;
require_once "./model/databaseModel.php";

use databaseModel\Database;
use Exception;
use PDO;
use PDOException;

class LanguageModel
{
	static public function index()
	{
		$connect = Database::connect();
		$query = "call get_all_languages()";
		$languages = $connect->query($query);
		$result = $languages->fetchAll(PDO::FETCH_ASSOC);

		if (!empty($result)) {
			return $result;
		} else {
			throw new Exception("No languages found");
		}
	}

	static public function store($language)
	{
		if (empty($language)) {
			throw new Exception("Language name is required");
		}

		$connect = Database::connect();
		$query = "call create_language(:language)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":language", $language, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "Language created successfully";
		} else {
			throw new Exception("Failed to create language");
		}
	}

	static public function delete($id)
	{
		if (empty($id)) {
			throw new Exception("Language ID is required");
		}

		$connect = Database::connect();
		$query = "call delete_language(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				return "Language deleted successfully";
			} else {
				throw new Exception("Language with ID $id does not exist");
			}
		} else {
			throw new Exception("Error deleting language");
		}
	}

	static public function update($id, $language_name)
	{
		if (empty($id) || empty($language_name)) {
			throw new Exception("Language ID and name are required");
		}

		$connect = Database::connect();
		$query = "call update_language(:id, :language_name)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":language_name", $language_name, PDO::PARAM_STR);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				return "Language updated successfully";
			} else {
				throw new Exception("Language with ID $id does not exist");
			}
		} else {
			throw new Exception("Error updating language");
		}
	}

	static public function show($id)
	{
		if (empty($id)) {
			throw new Exception("Language ID is required");
		}

		$connect = Database::connect();
		$query = "CALL get_language_by_id(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$language = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($language) {
				return $language;
			} else {
				throw new Exception("No language found with ID $id");
			}
		} else {
			throw new Exception("Error fetching language");
		}
	}
}
