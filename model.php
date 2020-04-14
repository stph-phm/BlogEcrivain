<?php

function getAllArticles()
{
    $db = dbConnect();
    $req = $db->query('SELECT id, chapter_order, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles ORDER BY chapter_order DESC');

    return $req;
}

function getArticle($id_article)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles WHERE id = ?');

    $req->execute(array($id_article));
    $post = $req->fetch();

    return $post;
}

function getAllComments($id_article)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, pseudo, comment, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM comments WHERE article_id = ? ORDER BY date_com DESC ');

    $comments->execute(array($id_article));
    return $comments;
}

function dbConnect()
{
    try 
    {
        $db = new PDO ('mysql:host=localhost;dbname=blog;charset=utf8','root','');

        return $db;
    } 
    catch (Exception $e) 
    {
        die('Erreur:' .$e->getMessage());
    }
}