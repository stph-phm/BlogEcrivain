<?php
namespace App\Model;

class Manager 
{
    /**
     * Connection database local blog
     * @return $db
     */
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        //$db = new \PDO('mysql:host=stephagblogp4.mysql.db;dbname=stephagblogp4;charset=utf8', 'stephagblogp4', 'BlogProjet4');
        return $db;
    }
}



