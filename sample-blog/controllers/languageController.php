<?php

namespace LanguageController;

require_once "./model/languageModel.php";

use Exception;
use LanguageModel\LanguageModel;

class LanguageController
{
    public function index()
    {
        try {
            $languages = LanguageModel::index();
            http_response_code(200);
            echo json_encode($languages);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function store($language)
    {
        try {
            $result = LanguageModel::store($language);
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
            $result = LanguageModel::delete($id);
            http_response_code(200);
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function update($id, $language_name)
    {
        try {
            $result = LanguageModel::update($id, $language_name);
            http_response_code(200);
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $language = LanguageModel::show($id);
            http_response_code(200);
            echo json_encode($language);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
