<?php 

namespace App\Controller; 

use App\Model\UserManager;

class Controller {
    // methodes pour savoir si le membre est connecter 
    public function is_connected()
    {
        if (isset($_SESSION['isConnected']) === 1) {
        
        } else {
            \header('Location: index.php');
        }

        //return $_SESSION['isConnected'] === 1
    }

    // méthode pour savoir si il est admin 
    public function is_admin()
    {
        if (isset($_SESSION['isAdmin']) === 1) {
            $isConnected = is_admin();
        } else {
            \header('Location: index.php');
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
}
