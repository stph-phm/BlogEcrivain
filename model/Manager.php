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
        $db = new \PDO('mysql:host=localhost;dbname=blog1;charset=utf8', 'root', '');
        return $db;
    }
}



