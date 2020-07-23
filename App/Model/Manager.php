<?php
namespace App\Model;

class Manager
{

    /**
     * @return \PDO
     */
    protected function dbConnect()
    {
        include_once \dirname(\dirname(__DIR__)). '/ressources/config.php';
        //constante définir le chemin vers le fichier de configuration
        //define('CONFIG_FILE_PATH', __DIR__. '/ressources/config.ini');
        // On utilise la function parse ini file pour récup dans l'array php
        //$conf = parse_ini_file(PHP_CONFIG_FILE_PATH, false);
        //formater le dsn qur l'on utilise pour construire la connection à la bdd
        //$dsn = sprintf('mysql:host=%s;dbname=%s', $conf['host'], $conf['dbname']);
        //$db = new \PDO($dsn, $conf['login'], $conf['password']);
        

        //$db = new \PDO('mysql:host=' . DATABASE_HOST . ';dbname='. DATABASE_NAME .';charset=utf8mb4', DATABASE_USER, DATABASE_PASSWORD);
        $db = new \PDO("mysql:host=$host;dbname=$dbName;charset=utf8",$login, $passwd);
        //$db = new \PDO('mysql:host='$host;dbname=$dbName;charset=utf8",$login, $passwd);
        //$db = new \PDO('mysql:host=stephagblogp4.mysql.db;dbname=stephagblogp4;charset=utf8', 'stephagblogp4', 'BlogProjet4');
        //$db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8','root', '');
        
        return $db;

        
    }

}
























