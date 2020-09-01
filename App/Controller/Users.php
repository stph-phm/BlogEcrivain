<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Session\FlashSession;

class Users extends Controller 
{

    /**
     * Users constructor.
     */
    public function __construct() {
        parent::__construct();
    }
    
    public function registerUser()
    {
        $username = "";
        $email = "";
        $pswd = "";
        $pswd2 ="";

        if (isset($_POST['register'])) {
            $username = $this->str_secur($_POST['username']);
            $email = $this->str_secur($_POST['email']);
            $pswd = $this->str_secur($_POST['pswd']);
            $pswd2 =  $this->str_secur($_POST['pswd2']);

            //is not
            if (!empty($username) && !empty($email) && !empty($pswd) && !empty($pswd2)) {
                $userManager = new UserManager();
                $userByUsername = $userManager->getUserByUsername($username);

                //is not
                if (!$userByUsername) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $userByEmail = $userManager->getUserByEmail($email);

                        //is not
                        if (!$userByEmail) {
                            if (strlen($this->trim_secur($pswd)) >= 5 ) {
                                if ($pswd == $pswd2) {
                                    $pswdHasch = password_hash($pswd, PASSWORD_DEFAULT);
                                    $userManager->addUser($username, $email, $pswdHasch);

                                    $flashSession = new FlashSession();
                                    $flashSession->addFlash('success', 'Inscription réussie ! Connectez-vous !');

                                    header('Location: index.php?action=login');
                                }
                                else {
                                    $errorMsg = "Les mots de passe ne se correspondent pas !";
                                }
                            }
                            else {
                                $errorMsg = "Le mot de passe doit faire plus de 5 caractère";
                            }
                        }
                        else {
                            $errorMsg = "L'adresse mail est déjà utilisée ! Veuillez choisi un autre !";
                        }
                    }
                    else {
                        $errorMsg = " L'adresse mail n'est pas valide! Veuillez recommencer !";
                    }
                }
                else {
                    $errorMsg = "L'identifiant existe déjà, veuillez choisir un nouvel !";
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
        $email = "";
        $pswd = "";
        
        if (isset($_POST['connect'])) {
            $email = $this->str_secur($_POST['email']);
            $pswd = $this->trim_secur($_POST['pswd']);
    
            if (!empty($email) && !empty($pswd)) {
                $userManager = new UserManager();
                $userByEmail = $userByEmail = $userManager->getUserByEmail($email);
                $pswdCorrect = password_verify($pswd, $userByEmail['password_user']);

                if ($pswdCorrect) {
                    $_SESSION['userId'] = $userByEmail['id'];
                    $hashSession = $this->hashSession($_SESSION['userId']);
                    $_SESSION['hashUserId'] = $hashSession;

                    $flashSession = new FlashSession();
                    $flashSession->addFlash('success',"Connexion réussi !");
                    \header('Location: index.php');
                } 
                else {
                    $errorMsg = "Vos identifiants sont incorrects ! ";
                }
            } 
            else {
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