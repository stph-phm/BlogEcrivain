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
            $usernameLength = \strlen($username);
            
            if (!empty($username) && !empty($email) && !empty($pswd) && !empty($pswd2)) {
                if ($usernameLength <= 20) {
                    $userExist = $userManager->ifUsernameExist($username);
                    if ($userExist == 0 ) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                            $mailExist = $userManager->ifMailExist($email);
                            if ($mailExist == 0) {
                                if ($pswd == $pswd2) {

                                    $pswdHach = password_hash($pswd, PASSWORD_DEFAULT);
                                    $inserUser = $userManager->addNewUser($username, $email, $pswdHach);

                                    header('Location: index.php?action=connectUser');
                                } else {
                                    throw new \Exception("Les mots de passe ne se correspondent pas !");
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
                    throw new \Exception("Votre identifiant doit avoir moins de 20 caractères !");
                    
                }
            } else {
                throw new \Exception("Veuillez remplir tous les champs ! ");
            }
        }
        include 'View/registerView.php';
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
            $user = $userManager->userByEmail($email);
            
    
            if (!empty($email) && !empty($pswd)) {
                $pswdCorrect = password_verify($pswd, $user['password_user']);

                if ($pswdCorrect) {
                    $userInfo = $userManager->getUserById($_SESSION['userId']);
                    $_SESSION['userId'] = $user['id'];
                    $hashSession = hash("sha256", $_SESSION['userId']);
                    \header('Location: index.php');
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
        
        if (isset($_SESSION['userId']) && $_SESSION['userId'] > 0) {
            $sessionId = $this->trim_secur($_SESSION['userId']);
            $userInfo = $userManager->getUserById($sessionId);
            $isConnect = $this->is_connected();
            $isAdmin = $this->is_admin();
        }
        include 'View/profilView.php';
    }

    public function logoutUser()
    {
        include 'view/Include/nav.php';
    }
}
