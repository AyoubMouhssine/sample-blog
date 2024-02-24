<?php
include_once "./config/cross-origin.php";
require_once "./controllers/apiController.php";

use ApiController\ApiController;

$request = $_SERVER['REQUEST_METHOD'];

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$data = json_decode(file_get_contents("php://input"), true);

$apiController = new ApiController();

try {
	switch ($request) {
		case "GET":
			$apiController->handleGetRequest($path, $_REQUEST);
			break;

		case "POST":
			$apiController->handlePostRequest($path, $_POST);
			break;

		case "DELETE":
			$apiController->handleDeleteRequest($path, $_REQUEST);
			break;
			
		case "PUT":
			$apiController->handlePutRequest($path, $data);
			break;

		default:
			header("HTTP/1.1 405 Method Not Allowed");
			exit();
	}
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['error' => $e->getMessage()]);
	exit();
}
