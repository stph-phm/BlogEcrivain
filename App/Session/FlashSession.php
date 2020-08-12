<?php 

namespace App\Session;

class FlashSession {

     public function get() {
          $_SESSION['flash'] = [];
          $this->delete();
          return $_SESSION['flash'] = [];
     }

     public function set($type = 'error' OR 'success' OR 'info', $message) {
          $_SESSION['flash'] = [
              'message'     => $message,
              'type'        => $type
          ];
     }

     public function delete() {
          unset($_SESSION['flash']);
     }
}

















