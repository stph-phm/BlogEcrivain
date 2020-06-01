<?php 

namespace App\Controller; 

use App\Model\UserManager;

class Controller {
    // methodes pour savoir si le membre est connecter 
    public function is_connected()
    {
        if (!empty($_SESSION['id'])) {
            die('OK');
        } else {
            header('Location: index.php');
        }
        return !empty($_SESSION['id']); 
    }

    // méthode pour savoir si il est admin 
    public function is_admin()
    {
        
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
