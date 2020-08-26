<?php

namespace App\Model;

use App\Model\Manager;

class ArticleManager extends Manager
{

    public $title;
    public $content;

    /**
     * @return array
     */
    public function listArticles()
    {
        $db = $this->dbConnect();
        $reqArticle = $db->query('
            SELECT id,  title, content,date_article
            FROM articles 
            ORDER BY date_article ASC');
        return  $articles = $reqArticle->fetchAll();
    }

    /**
     * @param $article_id
     * @return mixed
     */
    public function getArticle($article_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
            SELECT *
            FROM articles 
            WHERE id = :id 
        ');

        $req->execute([
            'id' => $article_id
        ]);

        return $article = $req->fetch();
    }

    /**

     * @return array
     */
    public function listLastArticles()
    {
        $db = $this->dbConnect();
        $reqArticles = $db->query('  
            SELECT * 
            FROM articles 
            ORDER BY date_article DESC LIMIT 0,5 
        ');
        $reqArticles->execute();
        return $lastArticles = $reqArticles->fetchAll();
    }


    public function addArticle($title, $content)
    {
        $db = $this->dbConnect();
        $reqArticle = $db->prepare('
        INSERT INTO articles (title,content, date_article) 
            VALUES(:title, :content, NOW())');

        $reqArticle->execute([
            'title' => $title,
            'content' => $content
        ]);
    }


    /**
     * Edit an article
     * @param $article_id (int), $title, $content
     */
    public function editArticle($article_id, $title, $content)
    {
        $db = $this->dbConnect();
        $reqArticle = $db->prepare(
            'UPDATE articles 
            SET title = :title, content = :content
            WHERE id = :id ');

        $reqArticle->execute([
            "id" => $article_id,
            "title" => $title,
            "content" => $content
            ]);
    }

    /**
     * @param $article_id
     */
    public function deleteArticle($article_id)
    {
        $db = $this->dbConnect();
        $reqArticle = $db->prepare('
            DELETE FROM articles
            WHERE id = :id');
        $reqArticle->execute([
            'id' => $article_id
        ]);
    }
}