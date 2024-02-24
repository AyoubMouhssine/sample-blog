<?php

namespace PostModel;

require_once "./model/databaseModel.php";

use databaseModel\Database;
use Exception;
use PDO;
use PDOException;

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
			throw new Exception("No posts found");
		}
	}

	static public function show($id)
	{
		$connect = Database::connect();
		$query = "CALL get_post_by_id(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if (!$stmt->execute()) {
			throw new Exception("No post found with ID = $id");
		}
		$post = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$post) {
			throw new Exception("No post found with ID = $id");
		}

		return $post;
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

		if ($stmt->execute()) {
			return "Post created successfully";
		} else {
			throw new Exception("Failed to create post");
		}
	}

	static public function delete($id)
	{
		$connect = Database::connect();
		$query = "call delete_post(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				return "Post deleted successfully";
			} else {
				throw new Exception("Post with ID $id does not exist");
			}
		} else {
			throw new Exception("Error deleting post");
		}
	}

	static function update($id, $title, $content)
	{
		$connect = Database::connect();
		$query = "call update_post(:id, :title, :content)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":content", $content, PDO::PARAM_STR);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				return "Post updated successfully";
			} else {
				throw new Exception("Post with ID $id does not exist");
			}
		} else {
			throw new Exception("Error updating post");
		}
	}
}
