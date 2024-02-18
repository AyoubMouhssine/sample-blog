<?php

namespace PostController;

require_once "./model/postModel.php";
require_once "./model/databaseModel.php";

use PostModel\PostModel;

class PostController
{
    static public function index()
    {
        echo json_encode(PostModel::index());
    }


    static public function show($id)
    {
        echo json_encode(PostModel::show($id));
    }

    static public function store($title, $content)
    {
        echo json_encode(PostModel::store($title, $content));
    }

    static public function delete($id)
    {
        echo json_encode(PostModel::delete($id));
    }
    static public function update($id, $title, $content)
    {
        echo json_encode(PostModel::update($id, $title, $content));
    }
}
