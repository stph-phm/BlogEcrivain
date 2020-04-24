<?php 
include_once 'controller/Article.php';
include_once 'controller/Comment.php';


$action = '';
if (isset($_GET['action'])) {
    $action = trim($_GET['action']);
}


switch ($action) {
    case 'allArticle':
        $listArticle = new  \OpenClassrooms\Blog\Controller\Article;
        $listArticle->allArticles();
        break;
    case 'article':
        $listArticle = new \OpenClassrooms\Blog\Controller\Article;
        $listArticle->article();
        break;
    case 'addComment':
        $comment = new \OpenClassrooms\Blog\Controller\Comment;
        $comment->addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']); // Changement de param $article_id, $pseudo, $comment => error ne reconnait pas les variables 
        break; 
    case 'reportComment':
        $comment = new \OpenClassrooms\Blog\Controller\Comment;
        $comment->reportComment($_GET['id'], $_POST['report']);
    case 'login':
        //affiche la page de connexion 
        // dirige le lien de admin
        break;
    case 'admin':
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
        $listArticle = new \OpenClassrooms\Blog\Controller\Article;
        $listArticle->allArticles();
        break;
}

