<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Controller\Controller;

class Users extends Controller 
{
    /**
     * Check if the register butto, exists
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
            $pswd = $this->trim_secur($_POST['pswd']);
            $pswd2 =  $this->trim_secur($_POST['pswd2']);
            
            if (!empty($username) && !empty($email) && !empty($pswd) && !empty($pswd2)) {   
                $userExist = $userManager->ifUsernameExist($username);
                    if ($userExist == 0 ) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                            $mailExist = $userManager->ifMailExist($email);
                            if ($mailExist == 0) {
                                if(strlen($pswd) >= 5) {

                                    if ($pswd == $pswd2) {

                                        $pswdHach = password_hash($pswd, PASSWORD_DEFAULT);
                                        $inserUser = $userManager->addNewUser($username, $email, $pswdHach);

                                        header('Location: index.php?action=connectUser');
                                    } else {
                                        throw new \Exception("Les mots de passe ne se correspondent pas !");
                                    }
                                } else{
                                    throw new \Exception("Le mot de passe doivent faire plus de 5 caractères");
                                    
                                }
                            } else {
                                throw new \Exception("Votre adresse mail est déjà utilisé ! ");
                                    
                            }
                        } else {
                            throw new \Exception("Votre adresse mail n'est pas valide !");
                        }
                    } else {
                        throw new \Exception("Votre identifiant est deja pris, veuillez choisir un nouveau");
                    }
            } else {
            throw new \Exception("Veuillez remplir tous les champs ! ");
        }
    }
        include 'view/registerView.php';
    }

    /**
     * 
     */
    public function connectUser()
    {
        $userManager = new UserManager();
        if (isset($_POST['connect'])) {
            $email = $this->str_secur($_POST['email']);
            $pswd = $this->trim_secur($_POST['pswd']);
    
            if (!empty($email) && !empty($pswd)) {
                $user = $userManager->userByEmail($email);
                $pswdCorrect = password_verify($pswd, $user['password_user']);

                if ($pswdCorrect) {
                    $_SESSION['userId'] = $user['id'];
                    $hashSession = $this->hashSession($_SESSION['userId']); 

                    $_SESSION['hashUserId'] = $hashSession;
                    \header('Location: index.php?action=profil&id='. $_SESSION['userId']);
                } else {
                    throw new \Exception(" Vos identifiants incorrects ! ");
                }
            } else {
                throw new \Exception("Veuillez remplir tous les champs ! ");
            }
        }

        include 'view/connectView.php';
    }


    public function profilUser() 
    {
        $userManager = new UserManager();
        $commentManager = new CommentManager();
        
        if (isset($_SESSION['userId']) && $_SESSION['userId'] > 0) {
            $sessionId = $this->trim_secur($_SESSION['userId']);
            $isConnect = $this->is_connected();
            $isAdmin = $this->is_admin();
                $userInfo = $userManager->getUserById($sessionId);
                $listCommentsReport = $commentManager->getAllReported();
                $i = 1;

        }
        include 'view/profilView.php';

    }

    public function logoutUser()
    {
        $_SESSION = array();
        session_destroy();
        \header("Location: index.php?action=login");
        include 'view/Include/nav.php';
    }
}
