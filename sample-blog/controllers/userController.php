<?php

namespace UserController;

require_once "./model/userModel.php";

use Exception;
use UserModel\UserModel;

class UserController
{
	public function index()
	{
		try {
			$result = UserModel::index();
			$users = [];

			foreach ($result as $res) {
				unset($res['password']); 
				array_push($users, $res);
			}

			http_response_code(200);
			echo json_encode($users);
		} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['error' => $e->getMessage()]);
		}
	}

	public function show($email, $password)
	{
		try {
			$user = UserModel::show($email, $password);
			unset($user['password']);
			http_response_code(200);
			echo json_encode($user);
		} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['error' => $e->getMessage()]);
		}
	}

	public function store($username, $email, $password)
	{
		try {
			$result = UserModel::store($username, $email, $password);

			http_response_code(201);
			echo json_encode($result);
		} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['error' => $e->getMessage()]);
		}
	}

	public function update($id, $username, $email, $password)
	{
		try {
			$result = UserModel::update($id, $username, $email, $password);

			http_response_code(200);
			echo json_encode($result);
		} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['error' => $e->getMessage()]);
		}
	}

	public function delete($id)
	{
		try {
			$result = UserModel::delete($id);
			http_response_code(200);
			echo json_encode($result);
		} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['error' => $e->getMessage()]);
		}
	}
}
