<?php
namespace OpenClassrooms\Blog;

use App\Blog\Controller\User;
use App\Blog\Controller\Article;
use App\Blog\Controller\Comments;



include_once 'controller/Article.php';
include_once 'controller/Comments.php';
include_once 'controller/User.php';


$action = '';
if (isset($_GET['action'])) {
    $action = trim($_GET['action']);
}

try {
    switch ($action) {
        case 'allArticle':
            $listArticle = new Article;
            $listArticle->allArticles();
            break;
        case 'article':
            $listArticle = new Article;
            $listArticle->article();
            break;
        case 'addComment':
            $comment = new Comments;
            $comment->addComment(); 
            break; 
        case 'reportComment':
            $comment = new Comments;
            $comment->reportComment();
        case 'login':
            $user = new User;
            $user->login();
            break;
        case 'admin':
            $user = new User;
            $user->dashboard();
            //zffiche les tableau article et commentaire signalés 
        break;
        case 'create':
            // Ajouter une nouvelle article 
            
            break;
        case 'see':
            // envoie le lien pour voir l'article 
            break;
        case 'edit':
            // modifier l'article
            break;
        case 'deleteArticle':
            //supprime l'article avec ses commentaires 
            break;
        case 'ignore':
            // ignorer les commentaire signalés
            break;
        case 'deleteComments':
            // supprimer les commentaires signalés
            break;
        default:
            $listArticle = new  Article;
            $listArticle->allArticles();
            break;
    }
} catch (Exception $e) {
    echo 'Erreur : ' .$e->getMessage();
}



