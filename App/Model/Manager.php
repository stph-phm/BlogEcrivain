<?php
namespace App\Model;
include_once 'BaseModel.php';

class Manager 
{
    /**
     * Connection database local blog
     * @return $db
     */
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        //$db = new \PDO($host,$dbName, $charset, $userDb,  $pswdDb );
        return $db;
    }


}



