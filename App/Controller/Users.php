<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Session\FlashSession;

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
        parent::__construct();
        $userManager = new UserManager();
        $username = "";
        $email = "";
        $pswd = "";
        $pswd2 ="";

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
                                    }
                                } else{
                                    $errorMsg = "Le mot de passe doivent faire plus de 5 caractères !";
                                }
                            } else {
                                $errorMsg = "Votre adresse mail est déja utilisé !" ;
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
        $flashSession = new FlashSession();
        parent::__construct();

        $email = "";
        $pswd = "";
        
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
                    $flashSession->set('success',"Connexion réussi !");
                } else {
                    $errorMsg = "Vos identifiants sont incorrects ! ";
                }
            } else {
                $errorMsg = "Vos identifiants sont incorrects ! ";
            }
        }

        include 'view/Visitor/connectView.php';
    }

    /**
     * 
     */
    public function profilUser() 
    {
        parent::__construct();
        if (!$this->isConnected) {
            header('Location: index.php');
        }
        include 'view/Visitor/profilView.php';
    }

    /**
     * 
     */
    public function logoutUser()
    {
        session_destroy();
        \header("Location: index.php?action=login");
        include 'view/Include/nav.php';
    }
}
