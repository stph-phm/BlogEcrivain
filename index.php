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
    case 'admin':
        $dashboard = new  \OpenClassrooms\Blog\Controller\Article;        
        $dashboard->managerReportComment();
        break;

    default:
        $listArticle = new \OpenClassrooms\Blog\Controller\Article;
        $listArticle->allArticles();
        break;
}

