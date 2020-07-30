<?php 

namespace App\Controller; 

use App\Model\UserManager;

class Controller {
    public $userInfo;

    // methodes pour savoir si le membre est connecter 
    public function is_connected()
    {
        if (isset($_SESSION['userId']) && $this->ifHashSession()) {
            $userManager = new UserManager;
            $this->userInfo = $userManager->getUserById($_SESSION['userId']);
        } else {
            $this->userInfo = false;
        }
        return $this->userInfo;
    }

    // méthode pour savoir si il est admin 
    public function is_admin()
    {
        
        if ($this->is_connected()) {
            if ($this->userInfo['is_admin'] == 1 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function ifHashSession() {

        $hashSession = $this->hashSession($_SESSION['userId']);
            if ($hashSession == $_SESSION['hashUserId']) {
                return true;
                
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

    public function hashSession($valeur) {
        return hash("sha256", $valeur);
    }
}
