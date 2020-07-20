<?php


namespace App\Controller;

class Error extends Controller
{
    public function displayErrorBlock(\Exception $e)
    {
        $errorMsgBlock = $e->getMessage();

        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include_once 'view/errorView.php';
    }
}