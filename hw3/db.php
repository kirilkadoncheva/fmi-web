<?php

class DB
{
    private $connection;

    public function __construct()
    {
        $dbhost = "localhost";
        $dbName = "hw3_db";
        $userName = "root";
        $userPassword = "pass";

        $this->connection = new PDO("mysql:host=$dbhost;dbname=$dbName", $userName, $userPassword,
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ));
    }


    public function getConnection()
    {
        return $this->connection;
    }
}


?>