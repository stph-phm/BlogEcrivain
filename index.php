<?php
session_start();
ini_set("display_errors", E_ALL);

include_once 'vendor/autoload.php';

use App\Controller\Users;
use App\Controller\Articles;
use App\Controller\Comments;


$action = '';
if (isset($_GET['action'])) {
    $action = trim($_GET['action']);
}

try {
    switch ($action) {
        case 'listArticle':
            $listsArticle = new Articles;
            $listsArticle->allArticles();
            break;
        case 'article':
            $article = new Articles;
            $article->article();
            break;
        case 'addComment':
            $comment = new Comments;
            $comment->addComment(); 
            break; 
        case 'reportComment':
            $comment = new Comments;
            $comment->reportComment();
            break;
        case 'login':
            $connectUser = new Users;
            $connectUser->connectUser();
            break;
        case 'register':
            $registerUser = new Users;
            $registerUser->registerUser();
            break;
        case 'profilUser':
            $profilUSer = new Users;
            $profilUSer->profilUser();
            break;
        case 'admin':
            $dashboard = new Users;
            $dashboard->dashboard();
        break;
        case 'validateReported':
            $validateReported = new Comments;
            $validateReported->validateReportCom();
            break;
        case 'deleteCommentReport':
            $deleteComReported = new Comments;
            $deleteComReported->deleteReportCom();
            break;
        case 'createArticle':
            $createArticle = new Articles;
            $createArticle->createArticle();
            break;
        case 'manageArticle':
            $manageArticle = new Articles;
            $manageArticle->manageArticle();
            break;
        case 'addArticle':
            $addArticle = new Articles;
            $addArticle->addArticle();
            break;
        case 'allArticleNav':
            $articlesNav = new Users;
            $articlesNav->listsArticleNav();
        case 'edit':
            // modifier l'article
            $editArticle = new Articles;
            $editArticle->editArticle();
            break;
        case 'deleteArticle':
            $deleteArticle = new Articles;
            $deleteArticle->deleteArticle();
            //supprime l'article avec ses commentaires 
            break;
        default:
            $listArticle = new  Articles;
            $listArticle->allArticles();
            break;
    }
} catch (\Exception $e) {
    echo 'Erreur : ' .$e->getMessage();
}



