<?php
namespace App\Blog\Controller;

include_once 'model/UserManager.php';

class User {
     // Connecter 
    public function login() 
    {
        $userManager = new \OpenClassrooms\Blog\Model\UserManager();
        $userManager->
        header('Location: index.php?action=admin');
        // vérifie si le button login existe 
        // Test si les champs sont remplis
        // verifie si le $_POST['username'] == username de la BDD  && $_POST['password'] == password_user de la BDD 
        // envoie la page adminView
        include 'model/connectView.php';
    }

    //Afficher le tableau de bord
    public function dashboard()
    {
        //Affiche un tableau avec tous les chapitres et les actions (voir, modifier et supprimer)
        // Un autre tableau avec tous les commentaires signalés avec les actions (ignorer et supprimer)
        // un bouton d'ajouter un nouveau article => envoie une nouvelle page (formulaire sous forme TinyMCE)
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        $dashboard = $articleManager->getAllArticles();
        include 'view/adminView.php';
    }


}