<?php 

namespace App\Session;

class FlashSession {
    

    public function getSession() {

        //récupère la valeure de $_Session['flash'] et renvoie un tableau vide s'il n'existe pas
        $flash = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flash;
    }


    public function addFlash($type , $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
}

















