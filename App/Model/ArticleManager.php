<?php

namespace App\Model;

use App\Model\Manager;

class ArticleManager extends Manager 
{
    public $article_id;
    public $title;
    public $content;
    public $date_article;
    public $chapter_order;

    /**
     * Get all articles in database articles
     * @return $article
     */
    public function getAllArticles()
    {
        $db = $this->dbConnect();
        $articles = $db->query(
            'SELECT id,  title, content,date_article
            FROM articles 
            ORDER BY date_article ASC');

        $listArticle = $articles->fetchAll();

        return $listArticle;
    }

    /**
     * Get 1 article accordin to the ID passed in param
     * @param $article_id
     * @return $article
     */
    public function getArticle($article_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
            'SELECT id, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' )AS date_fr 
            FROM articles 
            WHERE id = ?');

        $req->execute(array($article_id));
        $article = $req->fetch();

        return $article;
    }

    /**
     * Get last article in database articles 
     * @return $article 
     */
    public function getNewArticle()
    {
        $db = $this->dbConnect();
        $reqArticle = $db->query(
            'SELECT id,  title, content,date_article
            FROM articles 
            ORDER BY date_article DESC LIMIT 0,5');

        $newArticle = $reqArticle->fetchAll();

        return $newArticle;
    }

    /**
     * Create a new article 
     * @param $title, $content
     */
    public function addArticle($title, $content)
    {
        $db = $this->dbConnect();
        $reqArticle = $db->prepare(
            'INSERT INTO articles (title,content, date_article) 
            VALUES(:title, :content, NOW())');

        $insertArticle =  $reqArticle->execute([
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
            
        $edit = $reqArticle->execute([
            "id" => $article_id, 
            "title" => $title,
            "content" => $content
            ]);
    }
    
    /**
     * Delete an article 
     * @param $article_id
     */
    public function deleteArticle($article_id)
    {
        $db = $this->dbConnect();

        $reqArticle = $db->prepare('DELETE FROM articles WHERE id = ?'); 
        $deleteArticle = $reqArticle->execute(array($article_id));

        $reqArticle = $db->prepare('DELETE FROM comments WHERE id = ?'); 
        $deleteArticle = $reqArticle->execute(array($article_id));
    }
}