<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Controller\Controller;



class Users extends Controller 
{
    // Connecter 
    public function connectUser()
    {
        $userManager = new UserManager();

        if (isset($_POST['submit'])) {

            $password = sha1($_POST['password']); 
            $username = htmlspecialchars($_POST['identifiant']);

            if (!empty($username) && !empty($password)) {
                // Si username $username == username de la Bdd && $password == password_user de la bdd 
                header('Location: index.php?action=admin');
            } else {
                throw new \Exception("Veuillez remplir les champs pour vous connecter ! ");
                
            }

            // $connect = $userManager->loginUser($username, $password);
        }
        
        include 'view/connectView.php';
    }


    public function registerUser()
    {
        $userManager = new UserManager();

    if (isset($_POST['register'])) {
        $username   = trim(htmlspecialchars($_POST['username']));
        $email      = trim(htmlspecialchars($_POST['email']));
        $password   = trim($_POST['password']);
        $password2  = trim($_POST['password2']);

        $mailExiste = $userManager->validateEmail();

        if (!empty($username) && !empty($email) && !empty($password) && !empty($password2)) {
            if (strlen($username) <= 16) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ( $mailExiste['id'] == 0 ) {
                        if ($password == $password2) {
                            \password_hash($password ,PASSWORD_DEFAULT, );
                            
                            $mailValidation = $userManager->addUser($username, $email, $password);
                        } else {
                            throw new Exception( "Les mots de passe ne correspondent pas ");
                        }
                    } else {
                        throw new \Exception("Ce mail existe déjà");
                    }
                } else {
                    throw new \Exception("Votre adresse e-mail n'est pas valide");
                }
            } else {
                throw new \Exception('Votre identifiant est trop long ! Votre identifiant dois avoir moins de 16 caractères !  ');
                
            }
        } else {
            throw new \Exception('Veuillez remplir tous les champs !');
            
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
