<?php 

namespace App\Session;

class FlashSession {


    /**
     * @param $type
     * @param $message
     */
    public function addFlash($type , $message)
    {
        $value = [
            'type' =>$type,
            'message' => $message
        ];
        $_SESSION['flash'][] = $value;
    }

    /**
     * @return array|mixed
     */
    public function getSession()
    {
       $flash = $_SESSION['flash'] ?? [];
       unset($_SESSION['flash']);
       return $flash;
    }
}

















