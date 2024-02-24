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

	static public function store($username, $email, $password)
	{
		echo json_encode(UserModel::store($username, $email, $password));
	}

	static function update($id, $username, $email, $password)
	{
		echo json_encode(UserModel::update($id, $username, $email, $password));
	}

	static function delete($id)
	{
		echo json_encode(UserModel::delete($id));
	}
}
