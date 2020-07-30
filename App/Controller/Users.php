<?php

namespace App\Controller;

use App\Message\FlashMessage;
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
        $flashMessage = new FlashMessage();

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
                                        $flashMessage->setSuccessMsg("Inscription réussi ! Veuillez-vous connexter");
                                    } else {
                                        $flashMessage->setErrorMsg("Inscription incorrect !");
                                    }
                                } else{
                                    $flashMessage->setErrorMsg("Le mot de passe doivent faire plus de 5 caractères !");
                                }
                            } else {
                                $flashMessage->setErrorMsg("Votre adresse mail est déja utilisé !");
                            }
                        } else {
                            $flashMessage->setErrorMsg("Votre adresse mail n'est pas valide !");
                        }
                    } else {
                        $flashMessage->setErrorMsg("Votre identifiant est deja pris, veuillez choisir un nouveau");
                    }
            } else {
                $flashMessage->setErrorMsg("Veuillez remplir tous les champs ! ");
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
        $flashMessage = new FlashMessage();

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
                    $flashMessage->setSuccessMsg("Connexion réussi !");
                } else {
                    $flashMessage->setErrorMsg("Vos identifiants incorrects ! ");
                }
            } else {
                $flashMessage->setErrorMsg("Vos identifiants incorrects ! ");
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
        $flashMessage = new FlashMessage();
        $_SESSION = array();
        session_destroy();
        \header("Location: index.php?action=login");
        $flashMessage->setSuccessMsg("Vous êtes déconnecter !");
        include 'view/Include/nav.php';
    }
}
