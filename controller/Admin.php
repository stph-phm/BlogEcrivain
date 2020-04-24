<?php
namespace OpenClassrooms\Blog\Controller;

include_once 'model/UserManager.php';
include_once 'model/ArticleManager.php';
include_once 'model/CommentManager.php';

class Admin {
     // Connecter 
    public function login() 
    {
        header('Location: index.php?action=admin');
        // vérifie si le button login existe 
        // Test si les champs sont remplis
        // verifie si le $_POST['username'] == username de la BDD  && $_POST['password'] == password_user de la BDD 
        // envoie la page adminView
        include 'model/view/connectView.php';
    }

    //Afficher le tableau de bord
    public function dashboard()
    {
        //Affiche un tableau avec tous les chapitres et les actions (voir, modifier et supprimer)
        // Un autre tableau avec tous les commentaires signalés avec les actions (ignorer et supprimer)
        // un bouton d'ajouter un nouveau article => envoie une nouvelle page (formulaire sous forme TinyMCE)
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        $dashboard = $articleManager->getAllArticles();
        include 'view/frontend/adminView.php';
    }

    
    // Gestion des commentaires signalée
    // ignorer ou supprimer les commentaires signalés
    public function managerReportComment()
    {
        // verifie si le button ignore existe 
        // lorsqu'on click sur le button ignore => le commentaire ignorer ne sera plus signalé (il s'affiche plus dans le tableau)
        // redirige le lien tableau de bord ? 
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
        if (isset($_POST['ignore'])) {
            $ignored = $commentManager->ignoreComments($comment_id);

            header('Location: index.php?action=admin');
        }

        // Vérifie si le button delete comment existe
        // lorsqu'on click sur le button delete => supprime le commentaire 
        // redirige le lien tableau de bord ? 
        if (isset($_POST['deleteComment'])) {
            $deleteComment = $commentManager->deleteComments($comment_id);
            
            header('Location: index.php?action=admin');
        }
        include 'view/frontend/adminView.php';
    }

    // Gestion des articles 
    // Ajouter, Voir, Modifier et supprimer un article
    public function addArticle() {

        // verifie si id est en paramètre de l'URL ? (vérifie si on a bien récupérer l'id en URL)
        // Lorsqu'on click sur le button create => vérifie si les champs sont bien remplis 
        // appelle la méthode pour aouter les nouveaux articles 
        // redirige le lien en adminView avec un message ? 
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_POST['add'])) {
            $articleManager->createArticle($_POST['title'], $_POST['content']);
            header('Location: index.php?action=addArticle');
        }
    }

    public function editArticle()
    {
        // Verifie si le button edit existe bien (dans le tableau admin)
        // affiche le formulaire avec le titre et content en session ? 
        // si les champs sont remplis 
        // lorsqu'on click sur $_POST['submit_edit'] => appels la méthode 
        // redirige le lien en adminView avec un message ? 
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                if ($_POST['edit']) {
                    $articleManager->editArticles($_GET['id'], $_POST['title'], $_POST['content']);
                    
                    header('Location: index.php?action=edit');
                }
            }
        }
        include 'model/frontend/editView.php';
    }

    public function deleteArticle()
    {
        // Vérifie si le button delete existe bien (dans le tableau admin)
        // appele la méthode et supprime l'article & les commentaires 
        // une alerte pour confirmer la supression ? 
        // redirige le lien en adminViex avec un message ? 
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (isset($_POST['deleteArticle'])) {
                $deleteComment->deleteArticle($_GET['id']);
            }
        }
    }
}