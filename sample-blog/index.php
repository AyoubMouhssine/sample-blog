<?php
include_once "./config/cross-origin.php";
require_once "./controllers/postController.php";
require_once "./controllers/userController.php";
require_once "./controllers/languageController.php";

use UserController\UserController;
use PostController\PostController;
use LanguageController\LanguageController;
use LanguageModel\LanguageModel;
use UserModel\UserModel;

$request = $_SERVER['REQUEST_METHOD'];

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$params = $_REQUEST;

// data sent by "PUT" method;
$data = json_decode(file_get_contents("php://input"), true);


switch ($request) {
	case "GET":
		switch ($path) {
			case "/api/posts":
				PostController::index();
				break;

			case "/api/posts/show":
				PostController::show($params['id']);
				break;

			case "/api/users":
				UserController::index();
				break;

			case "/api/languages":
				LanguageController::index();
				break;
		}
		break;

	case "POST":
		switch ($path) {
			case "/api/posts/create":
				PostController::store($_POST['title'], $_POST['content'], $_POST['language'], $_POST['code'], $_POST['user_id']);
				break;

			case "/api/users/show":
				UserController::show($_POST['email'], $_POST['password']);
				break;

			case "/api/users/create":
				UserController::store($_POST['username'], $_POST['email'], $_POST['password']);
				break;

			case "/api/languages/create":
				LanguageController::store($_POST['language']);
				break;
		}
		break;

	case "DELETE":
		switch ($path) {
			case "/api/posts/delete":
				$id = $params['id'];
				PostController::delete($id);
				break;
			case "/api/users/delete":
				$id = $params['id'];
				UserModel::delete($id);
				break;
			case "/api/languages/delete":
				$id = $params['id'];
				LanguageController::delete($id);
				break;
		}
		break;
	case "PUT":
		switch ($path) {
			case "/api/posts/update":
				PostController::update($data['id'], $data['title'], $data['content']);
				break;
			case "/api/users/update":
				UserController::update($data['id'], $data['username'], $data['email'], $data['password']);
				break;
			case "/api/languages/update":
				LanguageController::update($data['id'], $data['language']);
				break;
		}

	default:
		header("HTTP/1.1 405 Method Not Allowed");
		exit();
}
