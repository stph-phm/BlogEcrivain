<?php
namespace App\Model;
class Environnement {
    public static function get()
    {
        return json_decode(file_get_contents('environnement.dev.json'));
    }

}


