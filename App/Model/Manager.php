<?php
namespace App\Model;

class Manager
{
    /**
     * @return \PDO
     */
    protected function dbConnect()
    {

        $db = new \PDO("mysql:host=$host;dbname=$dbName;charset=utf8",$userDb, $pswdDb);
        return $db;

        include_once 'ConnectData.php';
    }

}
























