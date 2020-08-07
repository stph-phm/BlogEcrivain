<?php 

namespace App\Session;

class FlashSession {

     public function get($key, $default = null) {
          if (array_key_exists($key, $_SESSION)) {
               return $_SESSION[$key];
          }
          return $default;
     }

     public function set($key, $message) {
          $_SESSION[$key] = $message;
     }

     public function delete($key) {
          unset($_SESSION[$key]);
     }
}