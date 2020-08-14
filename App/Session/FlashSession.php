<?php 

namespace App\Session;

class FlashSession {

    
    //permet de récupérer les messages du tableau $_Session
     public function get() {

         //récupère la valeure de $_Session['flash'] et renvoie un tableau vie s'il n'existe pas
         $flash = $_SESSION['flash'] ?? [];

          if ($_SESSION['flash'] = false) {
              unset($_SESSION['flash']);
          }
          return $flash;
     }

     // Permet d'ajouter un message dans le tableau Flash de la Session
     public function set($type , $message) {
         //récupère la valeure de $_Session['flash'] et renvoie un tableau vie s'il n'existe pas
         $flash = $_SESSION['flash'] ?? [];

         $flash[] = [
             'type' => $type,
             'message' => $message
         ];

         $_SESSION['flash'] = $flash;
     }

}

















