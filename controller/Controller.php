<?php 

namespace App\Controller; 

use App\Model\UserManager;

class Controller {
    // methodes pour savoir si le membre est connecter 
    public function is_connected()
    {
        $userManager = new UserManager();

    }

    // méthode pour savoir si il est admin 
    public function is_admin()
    {
        $userManager = new UserManager();
        $listUserAdmin = $userManager->getAllUserAdmin();

    }
}