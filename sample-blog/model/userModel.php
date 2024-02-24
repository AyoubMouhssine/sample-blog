<?php

namespace UserModel;

require_once "./model/databaseModel.php";

use databaseModel\Database;
use Exception;
use PDO;
use PDOException;

class UserModel
{
	static public function index()
	{
		try {
			$connect = Database::connect();
			$query = "call get_all_users()";
			$users = $connect->query($query);
			$result = $users->fetchAll(PDO::FETCH_ASSOC);

			return $result ? $result : [];
		} catch (PDOException $e) {
			throw new Exception("Database error: " . $e->getMessage());
		}
	}

	static function show($email, $password)
	{
		try {
			$connect = Database::connect();
			$query = "call get_user_by_email(:email)";
			$stmt = $connect->prepare($query);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$user) {
				return "User not found with email: $email";
			}

			if (!password_verify($password, $user['password'])) {
				return "Incorrect password";
			}

			return $user;
		} catch (PDOException $e) {
			throw new Exception("Database error: " . $e->getMessage());
		}
	}

	static public function store(string $username, string $email, string $password)
	{
		try {
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$connect = Database::connect();
			$stmt = $connect->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->fetchColumn()) {
				return "User already exists with email: $email";
			}

			$query = "call create_user(:username, :email, :password)";
			$stmt = $connect->prepare($query);
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);

			if ($stmt->execute()) {
				return "User created successfully";
			} else {
				return "Error creating user";
			}
		} catch (PDOException $e) {
			throw new Exception("Database error: " . $e->getMessage());
		}
	}

	static function update($id, $username, $email, $password)
	{
		try {
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$connect = Database::connect();
			$query = "call update_user(:id, :username, :email, :password)";
			$stmt = $connect->prepare($query);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				return "User updated successfully";
			} else {
				return "User with ID $id does not exist";
			}
		} catch (PDOException $e) {
			throw new Exception("Database error: " . $e->getMessage());
		}
	}

	static public function delete($id)
	{
		try {
			$connect = Database::connect();
			$query = "call delete_user(:id)";
			$stmt = $connect->prepare($query);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				return "User deleted successfully";
			} else {
				return "User with ID $id does not exist";
			}
		} catch (PDOException $e) {
			throw new Exception("Database error: " . $e->getMessage());
		}
	}
}
