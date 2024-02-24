<?php

namespace PostModel;

use databaseModel\Database;
use PDO;

class PostModel
{
	static public function index()
	{
		$connect = Database::connect();
		$query = "call get_all_posts()";
		$posts = $connect->query($query);
		$result = $posts->fetchAll(PDO::FETCH_ASSOC);

		if (count($result) > 0) {
			return $result;
		} else {
			$result = "aucun post trouve";
		}

		return $result;
	}

	static public function show($id)
	{
		$connect = Database::connect();
		$query = "CALL get_post_by_id(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if (!$stmt->execute()) {
			return "Aucun post trouve avec l'ID = {$id}";
		}
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$res) {
			return "Aucun post trouve avec l'id = {$id}";
		}

		return $res;
	}

	static public function store($title, $content, $language, $code, $user_id)
	{
		$connect = Database::connect();
		$query = "call create_post(:title, :content, :code, :user_id, :language_id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":content", $content, PDO::PARAM_STR);
		$stmt->bindParam(":code", $code, PDO::PARAM_STR);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":language_id", $language, PDO::PARAM_INT);
		$result = "";
		if ($stmt->execute()) {
			$result = "post created successfully";
		} else {
			$result = "faild creating post";
		}

		return $result;
	}

	static public function delete($id)
	{
		$connect = Database::connect();
		$query = "call delete_post(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$result = '';
		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				$result = "post deleted successfully";
			} else {
				$result = "post with id : {$id} does not exist";
			}
		} else {
			$result = "error deleting post";
		}
		return $result;
	}

	static function update($id, $title, $content)
	{
		$connect = Database::connect();
		$query = "call update_post(:id, :title, :content)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":content", $content, PDO::PARAM_STR);

		$result = '';

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				$result = "post updated successfully";
			} else {
				$result = "post with id : {$id} does not exists";
			}
		} else {
			$result = "error updating post";
		}

		return $result;
	}
}
