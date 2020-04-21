<?php
namespace OpenClassrooms\Blog\Model;

include_once 'model/Manager.php';

class ArticleManager extends Manager 
{
    public $article_id;

    /**
     * Get all articles in database articles
     * @return $article
     */
    public function getAllArticles()
    {
        $db = $this->dbConnect();
        $articles = $db->query('SELECT id, chapter_order, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles ORDER BY chapter_order DESC');
        
        $allArticles = $articles->fetchAll();

        return $allArticles;
    }

    /**
     * Get 1 article accordin to the ID passed in param
     * @param $article_id
     * @return $article
     */
    public function getArticle($article_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles WHERE id = ?');

        $req->execute(array($article_id));
        $article = $req->fetch();

        return $article;
    }

    /**
     * Get last article in database articles 
     * @return $article 
     */
    public function getLastArticle()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, chapter_order, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles ORDER BY chapter_order DESC LIMIT 1');

        $req->execute(array());
        $article = $req->fetch();

        return $article;
    }

    /**
     * Create a new article 
     * @param $title, $content
     */
    public function createArticle($title, $content)
    {
        $db = $this->dbConnect();
        $reqArticle = $db->prepare('INSERT INTO articles(title,content, date_article) VALUES(:title, :content, NOW())');
        $reqArticle->execute(array("title" => $title, "content" => $content));
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
            SET title= :title, content = :content, date_article = NOW() 
            WHERE id = :id ');
        $reqArticle->execute(array("id" => $article_id, "title" => $title, "content" => $content));
    }

    /**
     * Delete an article 
     * @param $article_id
     */
    public function deleteArticle($article_id)
    {
        $db = $this->dbConnect();

        $reqArticle = $db->prepare('DELETE FROM articles WHERE id = ?'); 
        $reqArticle->execute(array($article_id));

        $reqArticle = $db->prepare('DELETE FROM comments WHERE id = ?'); 
        $reqArticle->execute(array($article_id));
    }
}