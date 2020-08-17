<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Session\FlashSession;

class Users extends Controller 
{
        public function __construct() {
        parent::__construct();

    }
    
    public function registerUser()
    {
        $userManager = new UserManager();
        $flashSession = new FlashSession();
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

                if ($ifUserExist == 0) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $ifMailExist = $userManager->getIfMailExist($email);

                        if ($ifMailExist == 0 ) {

                            if (strlen($pswd) >= 5 ) {

                                if ($pswd == $pswd2) {
                                    $pswdHach = password_hash($pswd, PASSWORD_DEFAULT);
                                    $addUser = $userManager->addUSer($username, $email, $pswdHach);

                                    $flashSession->addFlash('success', 'Inscription réussi ! Vous pouvez connecter ! ');
                                    header('Location: index.php?action=connectUser');
                                }
                                else {
                                    $errorMsg = "Les mots de passe ne se correspondent pas !";
                                }
                            }
                            else {
                                $errorMsg = "Le mot de passe doit faire plus de 5 caractères !";
                            }
                        }
                        else {
                            $errorMsg = "Votre adresse mail est déja utilisé !" ;
                        }
                    }
                    else {
                        $errorMsg = "Votre adresse mail n'est pas valide !";
                    }
                }
                else {
                    $errorMsg = "Votre identifiant est deja pris, veuillez choisir un nouveau";
                }
            }
            else {
                $errorMsg = "Veuillez remplir tous les champs ! ";
            }
        }
        include 'view/Visitor/registerView.php';
    }

    public function connectUser()
    {
        $userManager = new UserManager();
        $flashSession = new FlashSession();

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

                    $flashSession->addFlash('success',"Connexion réussi !");
                    \header('Location: index.php');
                } else {
                    $errorMsg = "Vos identifiants sont incorrects ! ";
                }
            } else {
                $errorMsg = "Vos identifiants sont incorrects ! ";
            }
        }
        include 'view/Visitor/connectView.php';
    }

    public function profilUser() 
    {
        if (!$this->isConnected) {
            header('Location: index.php');
        }
        include 'view/Visitor/profilView.php';
    }

    public function logoutUser()
    {
        session_destroy();
        \header("Location: index.php?action=login");
    }
}
