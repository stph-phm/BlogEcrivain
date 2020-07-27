<?php


namespace App\Session;


class PHPSession
{


    /**
     * Ajouter des informations en Session en fonction des types
     * @param $text
     * @param $type
     */
    public function setMsg($text, $type)
    {
        if ($type == "error" )
        {
             $_SESSION['errorMsg'] = $text;
        }

        elseif ($type == "success" )
        {
            $_SESSION['successMsg'] = $text;
        }
    }

    /**
     * Afficher le message Flash
     */
    public function displayMsg()
    {
        if (isset($_SESSION['errorMsg']))
        {
            echo '<div class="alert-danger">'. $this . '</div>';
            unset($_SESSION['errorMsg']);
        }

        elseif (isset($_SESSION['successMsg']))
        {
            echo '<div class="alert-sucess">'. $_SESSION['successMsg'] . '</div>';
            unset($_SESSION['successMsg']);
        }
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        return $default;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     */
    public function delete(string $key)
    {
        unset($_SESSION[$key]);
    }
}