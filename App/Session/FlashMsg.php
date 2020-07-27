<?php


namespace App\Session;


class FlashMsg
{
    public function setMsg($type, $text) {
        if(isset($_SESSION[$type])) {
            $_SESSION[$type] = $text;
        }
    }


    public function typeFlashMsg ($type, $text)
    {
        if ($type == "success")
        {
            $_SESSION['successMsg'] = $text;
        } elseif ($type = "error")
        {
            $_SESSION['errorMsg'] = $text;
        }
    }

    public function showMsgFlash()
    {
        if (isset($_SESSION['errorMsg']))
        {
            echo '<div class="alert-danger">'. $_SESSION['errorMsg'] . '</div>';
            unset($_SESSION['errorMsg']);
        }

        elseif (isset($_SESSION['successMsg']))
        {
            echo '<div class="alert-sucess">'. $_SESSION['successMsg'] . '</div>';
            unset($_SESSION['successMsg']);
        }
    }

}