<?php 

namespace App\Controller; 

use App\Model\UserManager;

class Controller {
    public $tring;
    // methodes pour savoir si le membre est connecter 
    public function is_connected()
    {
        $userManager = new UserManager();
    }

    // méthode pour savoir si il est admin 
    public function is_admin()
    {
        $userManager = new UserManager();
    }

    public function str_secur($string)
    {
        return trim(htmlspecialchars($string));
    }

    public function trim_secur($string)
    {
        return trim($string);
    }
}
