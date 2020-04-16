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
    $addComment = addComments($article_id, $pseudo, $comment);

    if ($addComment === false) {
        die('Impossible d\'ajouter le commentaire !');
    } 
    else {
        header('Location: index.php?action=article&id='.$article_id);
    }
}
