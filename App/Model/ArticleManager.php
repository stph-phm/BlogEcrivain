<?php

namespace App\Model;

use App\Model\Manager;

class ArticleManager extends BaseModel
{
    public $article_id;
    public $title;
    public $content;
    public $date_article;
    public $chapter_order;

    /**
     * Get all articles in the Database
     * @return array
     */
    public function listArticles()
    {
        $db = $this->getBdd();
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
        $db = $this->getBdd();
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
     * Get the last 5 articles in Database 
     * @return array
     */
    public function listLastArticles()
    {
        $db = $this->getBdd();
        $reqArticle = $db->query('
            SELECT *
            FROM articles 
            ORDER BY date_article DESC LIMIT 0,5');
        return $lastArticles = $reqArticle->fetchAll();
    }


    public function addArticle($title, $content)
    {
        $db = $this->getBdd();
        $reqArticle = $db->prepare('
        INSERT INTO articles (title,content, date_article) 
            VALUES(:title, :content, NOW())');

        $addArticle =  $reqArticle->execute([
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
        $db = $this->getBdd();
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
        $db = $this->getBdd();
        $reqArticle = $db->prepare('
            DELETE FROM articles
            WHERE id = :id');
        $deleteArticle = $reqArticle->execute([
            'id' => $article_id
        ]);

        $reqArticle = $db->prepare('
            DELETE FROM comments 
            WHERE id = :id');
        $deleteArticle = $reqArticle->execute([
            'id' => $article_id
        ]);
    }

    public function nextArticle($article_id)
    {
        $db = $this->getBdd();
        $reqArticle = $db->prepare('
          SELECT * 
          FROM articles 
          WHERE id > id
          ORDER BY date_article DESC LIMIT 0,1 
        ');

        $reqArticle->execute([
            'id' => $article_id
        ]);
        return $nextArticle = $reqArticle->fetch();
    }

    public function previousArticle($article_id)
    {
        $db = $this->getBdd();
        $reqArticle = $db->prepare('
            SELECT * 
            FROM articles
            WHERE id  < :id 
            ORDER BY date_article DESC LIMIT 0,1
        ');
        $reqArticle->execute([
            'id' => $article_id
        ]);
        return $previousArticle = $reqArticle->fetch();
    }
}