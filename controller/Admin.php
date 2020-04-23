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
    }

    //Afficher le tableau de bord
    public function dashboard()
    {
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        $dashboard = $articleManager->getAllArticles();
        include 'view/frontend/adminView.php';
    }

    
    // Gestion des commentaires signalée
    // ignorer ou supprimer les commentaires signalés
    public function managerReportComment()
    {
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
        if (isset($_POST['ignore'])) {
            $ignored = $commentManager->ignoreComments($comment_id);

            header('Location: index.php?action=admin');
        }

        if (isset($_POST['deleteComment'])) {
            $deleteComment = $commentManager->deleteComments($comment_id);
            
            header('Location: index.php?action=admin');
        }
        include 'view/frontend/adminView.php';
    }

    // Gestion des articles 
    // Ajouter, Voir, Modifier et supprimer un article
    public function addArticle() {

        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_POST['add'])) {
            $articleManager->createArticle($_POST['title'], $_POST['content']);
            header('Location: index.php?action=addArticle');
        }
    }

    public function editArticle()
    {
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
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (isset($_POST['deleteArticle'])) {
                $deleteComment->deleteArticle($_GET['id']);
            }
        }
    }
}