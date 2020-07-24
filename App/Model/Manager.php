<?php
namespace App\Model;

class Manager
{

    /**
     * @return \PDO
     */
    protected function dbConnect()
    {
        include \dirname(\dirname(__DIR__)). '/config/config.php';

        $db = new \PDO("mysql:host=$host;dbname=$dbName;charset=utf8",$login, $passwd);
        return $db;
    }
}
























