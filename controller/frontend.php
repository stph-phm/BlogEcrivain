<?php 

include_once 'model/ArticleManager.php';
include_once 'model/CommentManager.php';

function allArticles()
{
    $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
    $req = $articleManager->getAllArticles();
    
    include 'view/frontend/allArticlesView.php';
}

function article()
{
    $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $article = $articleManager->getArticle($_GET['id']);
    $comments = $commentManager->getAllComments($_GET['id']);

    include 'view/frontend/articleView.php';
}

function addComment($article_id, $pseudo, $comment )
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $addLinesComment = $commentManager->getAddComments($article_id, $pseudo, $comment);

    if ($addLinesComment === true) {
        throw new Exception(' Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=article&id=' . $article_id);
    }
}
