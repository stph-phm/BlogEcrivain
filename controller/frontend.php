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


