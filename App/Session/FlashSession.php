<?php 

namespace App\Session;

class FlashSession {

    

     public function get() {

           $flash = $_SESSION['flash'] = array();

          if ($_SESSION['flash'] = false) {
              unset($_SESSION['flash']);
          }
          return $flash;
     }

     // Permet d'ajouter un message dans le tableau Flash de la Session
     public function set($type , $message) {
          $_SESSION['flash']= [
              'type'        => $type,
              'message'     => $message
          ];
     }


}

















