<?php 

namespace App\Controller; 

use App\Model\UserManager;

class Controller {
    // methodes pour savoir si le membre est connecter 
    public function is_connected()
    {
        if (isset($_SESSION['userId'])) {
            $hashSession = $this->hashSession($_SESSION['userId']);

            if ($hashSession == $_SESSION['hashUserId']) {

                $userManager = new UserManager;
                $userInfo = $userManager->getUserById($_SESSION['userId']);
                $this->$userInfo = true;
                // $this->is_connected = true;
                return true;
            }
        } else {
            // $this->is_connected() = false;
            $this->$userInfo = false;
            return false;
        }
    }

    // méthode pour savoir si il est admin 
    public function is_admin()
    {
        
        if ($this->is_connected()) {
            $this->$userInfo;

            if ($this->$userInfo['is_admin'] == 1 ) {
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

    public function hashSession($valeur) {
        return hash("sha256", $valeur);
    }
}
