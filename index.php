<?php
session_start();
ini_set("display_errors", E_ALL);

require_once 'vendor/autoload.php';

use App\Controller\Users;
use App\Controller\Articles;
use App\Controller\Comments;
use App\Controller\Error;

$action = '';
if (isset($_GET['action'])) {
    $action = trim($_GET['action']);
}

try {
    switch ($action) {
        case 'listArticles':
            $articles= new Articles;
            $articles->listArticles();
            break;
        case 'article':
            $article = new Articles;
            $article->displayArticle();
            break;
        case 'deleteComment':
            $deleteComment = new Comments;
            $deleteComment->deleteComment();
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
            $dashboard = new Comments;
            $dashboard->listReportComments();
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
            $editArticle = new Articles;
            $editArticle->editArticle();
            break;
        case 'deleteArticle':
            $deleteArticle = new Articles;
            $deleteArticle->deleteArticle();
            break;
        case 'logout':
            $logout = new Users;
            $logout->logoutUser();
            break;
        
        default:
            $lastArticles = new Articles;
            $lastArticles->home();
            break;
    }
} catch (\Exception $e) {
        $errorMsgBlock = new Error;
        $errorMsgBlock->displayErrorBlock($e);
}
