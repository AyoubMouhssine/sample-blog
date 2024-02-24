<?php

namespace UserModel;

use databaseModel\Database;
use PDO;
use PDOException;

class UserModel
{

	static public function index()
	{
		$connect = Database::connect();
		$query = "call get_all_users()";
		$users = $connect->query($query);
		$result = $users->fetchAll(PDO::FETCH_ASSOC);

		if (count($result) === 0) {
			return "aucun user trouve";
		}



		return $result;
	}

	static function show($email, $password)
	{
		$connect = Database::connect();
		$query = "call get_user_by_email(:email)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);



		try {
			if ($stmt->execute()) {


				$res = $stmt->fetch(PDO::FETCH_ASSOC);

				if (!$res) {
					// return "aucun utilisateur trouvé avec cet e-mail : {$email}";
					return "email";
				}
				if (!password_verify($password, $res['password'])) {
					return "password";
					// return false;

					// return "mot de passe incorrect";
				}

				unset($res['password']);
				return $res;
			} else {
				return "erreur lors de l'execution de la requete";
			}
		} catch (PDOException $e) {
			return "erreur de base de données : " . $e->getMessage();
		}
	}

	static public function store(string $username, string $email, string $password)
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		if (empty($username) || empty($email) || empty($password)) {
			return "All fields all required";
		}
		$connect = Database::connect();


		$stmt = $connect->prepare("select * from users where email = :email");

		$stmt->bindParam(":email", $email);


		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return "user deja exists avec cette email: {$email}";
		}
		$query = "call create_user(:username, :email, :password)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
		$result = "";
		try {
			if ($stmt->execute()) {
				$result =  "User created successfully";
			} else {
				$result = "Error creating user";
			}
		} catch (PDOException $e) {
			$result =  "Database error: " . $e->getMessage();
		}
		return $result;
	}

	static function update($id, $username, $email, $password)
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$connect = Database::connect();
		$query = "call update_user(:id, :username, :email, :password)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);

		$result = '';

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				$result = "user updated successfully";
			} else {
				$result = "user with id : {$id} does not exists";
			}
		} else {
			$result = "error updating user";
		}

		return $result;
	}

	static public function delete($id)
	{
		$connect = Database::connect();
		$query = "call delete_user(:id)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$result = '';
		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				$result = "user deleted successfully";
			} else {
				$result = "user with id : {$id} does not exist";
			}
		} else {
			$result = "error deleting user";
		}
		return $result;
	}
}
