<?php


namespace App\Controller;

class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param \Exception $e
     */
    public function displayErrorBlock(\Exception $e)
    {
        $errorMsgBlock = $e->getMessage();
        include_once 'view/errorView.php';
    }
}