<?php 

include_once 'model/ArticleManager.php';
include_once 'model/CommentManager.php';

function allArticles()
{
    $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
    $articles = $articleManager->getAllArticles();
    
    include 'view/frontend/allArticlesView.php';
}

function article()
{
    $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    if (isset($_GET['id']) && $_GET['id'] > 0 ) {
        $article = $articleManager->getArticle($_GET['id']);
        $comments = $commentManager->getAllComments($_GET['id']);
    } 
    else {
        echo('Aucun identifiant de billet envoyé');
    }
    include 'view/frontend/articleView.php';
}

function addComment($article_id, $pseudo, $comment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
            $addLinesComment = $commentManager->getAddComments($_GET['id'], $_POST['pseudo'], $_POST['comment']);
            
            header('Location: index?php?action=article&id=' .$article_id);
        }
        else {
            echo 'Veuillez remplir les champs ';
        }
        if ($addLinesComment === false) {
            echo 'Impossible d\'ajouter les commentaires';
        } 
    }
}