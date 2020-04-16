<?php 

include 'model/frontend.php';

function allArticles()
{

    $req = getAllArticles();
    
    include 'view/frontend/allArticlesView.php';
}

function article()
{
    $article = getArticle($_GET['id']);
    $comments = getAllComments($_GET['id']);

    include 'view/frontend/articleView.php';
}

function addComment($article_id, $pseudo, $comment )
{
    $addLinesComment = getAddComments($article_id, $pseudo, $comment);

    if ($addLinesComment === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } 
    else {
        header('Location: index.php?action=article&id='.$article_id);
    }
}
