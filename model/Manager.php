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
        return $db;

        //$db = new \PDO('mysql:host=db5000456374.hosting-data.io;dbname=dbs437052;charset=utf8', 'dbu425259', 'Phanie.9870');
        //return $db;
    }
}



