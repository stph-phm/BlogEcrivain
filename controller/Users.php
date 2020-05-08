<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;



class Users
{
    // Connecter 
    public function connectUser()
    {
        $userManager = new UserManager();

        if (isset($_POST['submit'])) {
            $password = sha1($_POST['password']);
            $username = htmlspechials($_POST['identifiant']);

            if (!empty($username) && !empty($password))  {
                // Si username $username == username de la Bdd && $password == password_user de la bdd 
            } else {
                throw new \Exception("Veuillez remplir les champs pour vous connecter ! ");
                
            }

            // $connect = $userManager->username($username);
        }
        
        include 'view/connectView.php';
    }


    public function registerUser()
    {
        $userManager = new UserManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {

            $username       = trim(htmlspecialchars($_POST['username']));
            $email_user     = trim(htmlspecialchars($_POST['email']));
            $password_user  = sha1(trim($_POST['password']));
            $password2      = sha1(trim($_POST['password2'])); // password_hach & password_verify & crypt 
            $register       = $_POST['register']; // buton inscrire 

            if (isset($register)) { 
                if (!empty($username) && !empty($email_user) && !empty($password_user) && !empty($password2)) {

                    if (strlen($username) <= 16 ) {
                        if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email_user)) {
                                if ($password_user == $password2) {
                                    
                                    $createUser = $userManager->addUser($username, $email_user, $password_user);

                                    header('Location: index.php?action=connectUser');
                                } else {
                                    throw new \Exception("Vos mots de passe ne se correspondent pas");
                                    
                                }
                            } else {
                                throw new \Exception("Votre adresse mail n'est pas valide ");
                            }
                        } else {
                            throw new \Exception("Votre adresse e-mail n'est pas valide");

                        }
                    } else {
                        throw new \Exception("L'identifiant est trop long...");
                        
                    }
                } else {
                    throw new \Exception("Veuillez remplir tous les champs ! ");
                }
                
            }
        }

        include 'view/registerView.php';
    }

    //Afficher le tableau de bord
    public function dashboard()
    {
        //Affiche un tableau avec tous les chapitres et les actions (voir, modifier et supprimer)
        // Un autre tableau avec tous les commentaires signalés avec les actions (ignorer et supprimer)
        // un bouton d'ajouter un nouveau article => envoie une nouvelle page (formulaire sous forme TinyMCE)
        $i = 1;
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $dashboard = $articleManager->getAllArticles();
        $dashboard = $commentManager->getAllReported();
        include 'view/adminView.php';
    }
}
