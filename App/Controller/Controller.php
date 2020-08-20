<?php 

namespace App\Controller; 

use App\Model\UserManager;
use App\Session\FlashSession;


class Controller {
    public $userInfo;
    public $isConnected;
    public $isAdmin;
    public $displayFlash;


    /**
     * Controller constructor.
     */
    function __construct() {
        $this->isConnected = $this->is_connected();
        $this->isAdmin = $this->is_admin();
        $this->displayFlash = $this->displayFlash();
        }

    /**
     * @return false|mixed
     */
    public function is_connected()
    {
        if (isset($_SESSION['userId']) && $this->ifHashSession()) {
            $userManager = new UserManager;
            $this->userInfo = $userManager->getUserById($_SESSION['userId']);
        } else {
            $this->userInfo = false;
        }
        return $this->userInfo;
    }

    /**
     * @return bool
     */
    public function is_admin()
    {
        
        if ($this->is_connected()) {
            if ($this->userInfo['is_admin'] == 1 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function ifHashSession() {

        $hashSession = $this->hashSession($_SESSION['userId']);
            if ($hashSession == $_SESSION['hashUserId']) {
                return true;
                
            } else {
                return false;
            }
    }

    /**
     * @param $string
     * @return string
     */
    public function str_secur($string)
    {
        return trim(htmlspecialchars($string));
    }

    /**
     * @param $string
     * @return string
     */
    public function trim_secur($string)
    {
        return trim($string);
    }

    /**
     * @param $string
     * @return string
     */
    public function nl2br_secur($string)
    {
        return nl2br($string);
    }

    /**
     * @param $valeur
     * @return string
     */
    public function hashSession($valeur) {
        return hash("sha256", $valeur);
    }



    public function displayFlash() {
        if (isset($_SESSION['flash'])) {
            $flashSession = new FlashSession();
            return $flashSession->getSession();
        }
        return [];
    }
}
