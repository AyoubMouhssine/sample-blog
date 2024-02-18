<?php

namespace databaseModel;

use PDO;
use PDOException;


class Database
{

    static public function connect()
    {
        $config = require_once "./config/config.php";

        $host = $config['db_host'];
        $dbname = $config['db_name'];
        $username = $config['db_username'];
        $password = $config['db_password'];
        $dbtype = $config['db_type'];
        try {

            $pdo =  new PDO($dbtype . ":host=" . $host . ";dbname=" . $dbname, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed " . $e->getMessage();
        }
        return $pdo;
    }
}
