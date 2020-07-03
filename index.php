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
        case 'home':
            $newArticle = new Articles;
            $newArticle->latestArticle();
            break;
        case 'allArticle':
            $listArticle = new Articles; 
            $listArticle->allArticle();
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
        case 'profil':
            $profilUSer = new Users;
            $profilUSer->profilUser();
            break;
        case 'dashboard':
            $dashboard = new Articles;
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
        case 'newArticle':
            $createArticle = new Articles;
            $createArticle->addArticle();
            break;
        case 'manageArticle':
            $manageArticle = new Articles;
            $manageArticle->manageArticle();
            break;
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
        case 'nav':
            $listArticle = new Articles;
            $listArticle->listArticleNav();
            break;
        case 'logout':
            $logout = new Users;
            $logout->logoutUser();
            break;
        default:
            $newArticle = new Articles;
            $newArticle->latestArticle();
            break;
    }
} catch (\Exception $e) {
    echo 'Erreur : ' .$e->getMessage();
}



