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
					return "aucun utilisateur trouvé avec cet e-mail : {$email}";
				}
				if (!password_verify($password, $res['password'])) {
					return "mot de passe incorrect";
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

	static public function store(string $nom, string $prenom, string $email, string $password)
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
			return "All fields all required";
		}
		$connect = Database::connect();


		$stmt = $connect->prepare("select * from users where email = :email");

		$stmt->bindParam(":email", $email);


		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return "user deja exists avec cette email: {$email}";
		}
		$query = "call create_user(:nom, :prenom, :email, :password)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
		$stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
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
}
