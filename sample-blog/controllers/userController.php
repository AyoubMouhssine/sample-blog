<?php

namespace UserController;

require_once "./model/userModel.php";
require_once "./model/databaseModel.php";

use UserModel\UserModel;

class UserController
{
	static public function index()
	{
		$result = UserModel::index();
		$users = [];

		foreach ($result as $res) {
			unset($res['password']);
			array_push($users, $res);
		}

		echo json_encode($users);
	}

	static public function show($email, $password)
	{
		echo json_encode(UserModel::show($email, $password));
	}

	static public function store($nom, $prenom, $email, $password)
	{
		echo json_encode(UserModel::store($nom, $prenom, $email, $password));
	}
}
