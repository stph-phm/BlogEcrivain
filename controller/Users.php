<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Controller\Controller;



class Users extends Controller 
{
    /**
     * Vérifie si le button register existe 
     * Sécurisé les variables 
     * Plusieurs vérifications : 
     * Des champs remplis, le nombre de caractères, vérifier l'adresse mail et unique et les mots de passe 
     * appelle 2 méthodes checkMail et addUser 
     */
    public function registerUser()
    {
        $userManager = new UserManager();
        
        if (isset($_POST['register'])) {
            
            $username = \trim(\htmlspecialchars($_POST['username']));
            $email = \trim(htmlspecialchars($_POST['email']));
            $pswd = \trim($_POST['pswd']);
            $pswd2 = \trim($_POST['pswd2']);

            if (!empty($username) && !empty($email) && !empty($pswd) && !empty($pswd2)) {
                $usernameLentght = \strlen($username);

                if ($usernameLentght <= 20) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $mailExist = $userManager->checkMail($email);

                        if ($mailExist == 0) {
                            $pswdHach = \password_hash($pswd, PASSWORD_DEFAULT);

                            if ($pswd == $pswd2) {
                                $insertUser = $userManager->addUser($username, $email, $pswdHach);
                                \header('Location: index.php?action=connectUser');
                            } else {
                                throw new \Exception("Les mots de passe ne correspondent pas ! ");
                            }
                        } else {
                            throw new \Exception("Votre adresse mail déjà utilisé");
                        }
                    }else {
                        throw new \Exception("Votre adresse mail n'est pas valide");
                    }
                } else {
                    throw new \Exception("Votre identifiant doit avoir 20 caractères ! ");
                }
            } else {
                throw new \Exception("Veuillez remplir tous les champs ! ");
            }
        }
        include 'View/registerView.php';
    }

    public function connectUser()
    {
        $userManager = new UserManager();

        if (isset($_POST['connect'])) {
            $email = trim(\htmlspecialchars($_POST['email']));
            $pswd = trim($_POST['pswd']);

            $pswdVerify = \password_verify($pswd, $pswdHach);

            if (!empty($email) && !empty($pswd)) {
                $userExist = $userManager->loginUser($email, $pswd); 

                if ($userExist == 1) {
                    $userInfo = $userManager->getProfilUser();

                    $_SESSION['id'] = $userInfo['id'];
                    $_SESSION['username'] = $userInfo['username'];
                    $_SESSION['email'] = $userInfo['email_user'];
                    
                    \header('Location: index.php?action=profilUSer');
                } else {
                    throw new \Exception("Adresse mail ou mot de passe incorrect ! ");
                    
                }
            } else {
                throw new \Exception("Tous les champs doivent être remplis !");
                
            }
        }
        include 'View/connectView.php';
    }

    public function profilUser() 
    {
        $userManager = new UserManager();
        include 'View/profilView.php';
    }
}
