<?php 

namespace App\Controller; 

use App\Model\UserManager;

class Controller {
    // methodes pour savoir si le membre est connecter 
    public function is_connected()
    {
        if (isset($_SESSION['userId'])) {
            return true;
        } else {
            return false;
        }
    }

    // méthode pour savoir si il est admin 
    public function is_admin()
    {
        if ($this->is_connected()) {
            if (isset($_SESSION['userId'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function str_secur($string)
    {
        return trim(htmlspecialchars($string));
    }

    public function trim_secur($string)
    {
        return trim($string);
    }

    public function nl2br_secur($string)
    {
        return nl2br($string);
    }
}
