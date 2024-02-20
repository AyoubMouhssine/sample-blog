<?php
include_once "./config/cross-origin.php";
require_once "./controllers/postController.php";
require_once "./controllers/userController.php";

use UserController\UserController;
use PostController\PostController;

$request = $_SERVER['REQUEST_METHOD'];

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$params = $_REQUEST;

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
		}
		break;

	case "POST":
		switch ($path) {
			case "/api/posts/create":
				PostController::store($_POST['title'], $_POST['content'], $_POST['language'], $_POST['code']);
				break;
			case "/api/users/show":
				UserController::show($_POST['email'], $_POST['password']);
				break;
			case "/api/users/create":
				UserController::store($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);
				break;
		}
		break;

	case "DELETE":
		switch ($path) {
			case "/api/posts/delete":
				$id = $params['id'];
				PostController::delete($id);
				break;
		}
		break;
	case "PUT":
		switch ($path) {
			case "/api/posts/update": // headers: {'Content-Type': 'application/json'},
				$body = file_get_contents("php://input");
				$data = json_decode($body, true);
				PostController::update($data['id'], $data['title'], $data['content']);
				break;
		}

	default:
		// Return 405 Method Not Allowed for unsupported methods
		header("HTTP/1.1 405 Method Not Allowed");
		exit();
}
