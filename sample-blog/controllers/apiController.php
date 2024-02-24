<?php

namespace ApiController;


require_once "./controllers/postController.php";
require_once "./controllers/UserController.php";
require_once "./controllers/LanguageController.php";

use Exception;
use LanguageController\LanguageController;
use PostController\PostController;
use UserController\UserController;

class ApiController
{
    private $postController;
    private $userController;
    private $languageController;

    public function __construct()
    {
        $this->postController = new PostController();
        $this->userController = new UserController();
        $this->languageController = new LanguageController();
    }


    public function handleGetRequest($path, $params)
    {
        switch ($path) {
            case "/api/posts":
                $this->postController->index();
                break;

            case "/api/posts/show":
                $this->postController->show($params['id']);
                break;

            case "/api/users":
                $this->userController->index();
                break;

            case "/api/languages":
                $this->languageController->index();
                break;

            case "/api/languages/show":
                $this->languageController->show($params['id']);
                break;
            default:
                http_response_code(404);
                exit();
        }
    }

    public function handlePostRequest($path, $data)
    {
        switch ($path) {
            case "/api/posts/create":
                $this->validateData($data, ['title', 'content', 'language', 'code', 'user_id']);
                $this->postController->store($data['title'], $data['content'], $data['language'], $data['code'], $data['user_id']);
                break;

            case "/api/users/show":
                $this->validateData($data, ['email', 'password']);
                $this->userController->show($data['email'], $data['password']);
                break;

            case "/api/users/create":
                $this->validateData($data, ['username', 'email', 'password']);
                $this->userController->store($data['username'], $data['email'], $data['password']);
                break;

            case "/api/languages/create":
                $this->validateData($data, ['language']);
                $this->languageController->store($data['language']);
                break;
            default:
                http_response_code(404);
                exit();
        }
    }

    public function handleDeleteRequest($path, $params)
    {
        switch ($path) {
            case "/api/posts/delete":
                $this->validateId($params, 'post');
                $this->postController->delete($params['id']);
                break;
            case "/api/users/delete":
                $this->validateId($params, 'user');
                $this->userController->delete($params['id']);
                break;
            case "/api/languages/delete":
                $this->validateId($params, 'language');
                $this->languageController->delete($params['id']);
                break;
            default:
                http_response_code(404);
                exit();
        }
    }

    public function handlePutRequest($path, $data)
    {
        switch ($path) {
            case "/api/posts/update":
                $this->validateData($data, ['id', 'title', 'content']);
                $this->postController->update($data['id'], $data['title'], $data['content']);
                break;
            case "/api/users/update":
                $this->validateData($data, ['id', 'username', 'email', 'password']);
                $this->userController->update($data['id'], $data['username'], $data['email'], $data['password']);
                break;
            case "/api/languages/update":
                $this->validateData($data, ['language']);
                $this->languageController->update($data['id'], $data['language']);
                break;
            default:
                http_response_code(404);
                exit();
        }
    }

    private function validateData($data, $requiredFields)
    {
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new Exception("Missing or empty required field: $field");
            }
        }
    }

    private function validateId($params, $entity)
    {
        if (!isset($params['id']) || !is_numeric($params['id']) || $params['id'] <= 0) {
            throw new Exception("Invalid or missing ID for $entity");
        }
    }
}
