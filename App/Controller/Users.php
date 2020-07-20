<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Controller\Controller;

class Users extends Controller 
{
    /**
     * Check if the button exists
     * Secrure the variables by calling different mothods in the Controller class 
     * and using 2 functions the strlen and hashing the password 
     * several test :  
     * empty filds, number of caractères, existings username, valid mails and existing mails
     * call the method to insert a new user
     */
    public function registerUser()
    {
        $userManager = new UserManager();
        if (isset($_POST['register'])) {
            
            $username = $this->str_secur($_POST['username']);
            $email = $this->str_secur($_POST['email']);
            $pswd = $_POST['pswd'];
            $pswd2 =  $_POST['pswd2'];
            
            if (!empty($username) && !empty($email) && !empty($pswd) && !empty($pswd2)) {   
                $ifUserExist = $userManager->getIfUsernameExist($username);
                    if ($ifUserExist == 0 ) {

                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                            $ifMailExist = $userManager->getIfMailExist($email);
                            if ($ifMailExist == 0) {

                                if(strlen($pswd) >= 5) {
                                    if ($pswd == $pswd2) {

                                        $pswdHach = password_hash($pswd, PASSWORD_DEFAULT);
                                        $addUser = $userManager->addUSer($username, $email, $pswdHach);

                                        header('Location: index.php?action=connectUser');
                                    } else {
                                        $errorMsg = "Les mots de passe ne se correspondent pas !";
                                    }
                                } else{
                                    $errorMsg = "Le mot de passe doivent faire plus de 5 caractères";
                                }
                            } else {
                                $errorMsg = "Votre adresse mail est déjà utilisé ! ";
                            }
                        } else {
                            $errorMsg = "Votre adresse mail n'est pas valide !";
                        }
                    } else {
                        $errorMsg = "Votre identifiant est deja pris, veuillez choisir un nouveau";
                    }
            } else {
            $errorMsg = "Veuillez remplir tous les champs ! ";
        }
    }
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include 'view/Visitor/registerView.php';
    }

    /** Check if the button connect
     * Secrure the variables by calling different mothods in the Controller class 
     * and using 
     * several test :  
     * empty $empty & $pswd
     * verify 
     */
    public function connectUser()
    {
        $userManager = new UserManager();
        if (isset($_POST['connect'])) {
            $email = $this->str_secur($_POST['email']);
            $pswd = $this->trim_secur($_POST['pswd']);
    
            if (!empty($email) && !empty($pswd)) {
                $userByEmail = $userManager->getUserByEmail($email);
                $pswdCorrect = password_verify($pswd, $userByEmail['password_user']);

                if ($pswdCorrect) {
                    $_SESSION['userId'] = $userByEmail['id'];
                    $hashSession = $this->hashSession($_SESSION['userId']);
                    $_SESSION['hashUserId'] = $hashSession;

                    
                    \header('Location: index.php');
                } else {
                    $errorMsg = "Vos identifiants incorrects ! ";
                }
            } else {
                $errorMsg = "Veuillez remplir tous les champs ! ";
            }
        }
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include 'view/Visitor/connectView.php';
    }

    /**
     * 
     */
    public function profilUser() 
    {
        $userManager = new UserManager();
        if ($this->is_connected()) {
            $userInfo = $this->userInfo['id'];
        } else {
            \header("Location: index.php");
        }
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include 'view/Visitor/profilView.php';
    }

    /**
     * 
     */
    public function logoutUser()
    {
        $_SESSION = array();
        session_destroy();
        \header("Location: index.php?action=login");
        include 'view/Include/nav.php';
    }
}
