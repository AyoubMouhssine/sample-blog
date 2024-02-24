<?php

namespace LanguageController;

require_once "./model/languageModel.php";
require_once "./model/databaseModel.php";

use LanguageModel\LanguageModel;

class LanguageController
{
    static public function index()
    {
        echo json_encode(LanguageModel::index());
    }

    static public function store($language)
    {
        echo json_encode(LanguageModel::store($language));
    }

    static public function delete($id)
    {
        echo json_encode(LanguageModel::delete($id));
    }

    static public function update($id, $language_name)
    {
        echo json_encode(LanguageModel::update($id, $language_name));
    }
}
