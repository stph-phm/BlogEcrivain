<?php
namespace OpenClassrooms\Blog\Model;

include_once 'model/Manager.php';

class ArticleManager extends Manager 
{
    public function getAllArticles()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, chapter_order, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles ORDER BY chapter_order DESC');

        return $req;
    }

    public function getArticle($article_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles WHERE id = ?');

        $req->execute(array($article_id));
        $article = $req->fetch();

        return $article;
    }
}