<?php

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
        case 'allArticle':
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
        case 'connectUser':
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
        case 'publishArticle':
            $publishArticle = new Articles;
            $publishArticle->addArticle();
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
            $listArticle = new  Articles;
            $listArticle->allArticles();
            break;
    }
} catch (\Exception $e) {
    echo 'Erreur : ' .$e->getMessage();
}



