<?php

namespace PostController;

require_once "./model/postModel.php";

use Exception;
use PostModel\PostModel;

class PostController
{
    public function index()
    {
        try {
            $posts = PostModel::index();
            http_response_code(200);
            echo json_encode($posts);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $post = PostModel::show($id);
            http_response_code(200);
            echo json_encode($post);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function store($title, $content, $language, $code, $user_id)
    {
        try {
            $result = PostModel::store($title, $content, $language, $code, $user_id);
            http_response_code(201);
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $result = PostModel::delete($id);
            http_response_code(200);
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function update($id, $title, $content)
    {
        try {
            $result = PostModel::update($id, $title, $content);
            http_response_code(200);
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
