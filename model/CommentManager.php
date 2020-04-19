<?php
namespace OpenClassrooms\Blog\Model;

include_once 'model/Manager.php';

class CommentManager extends Manager
{
    public $article_id;
    public $pseudo;
    public $comment;

    /**
     * Get all comments in database in comments
     * @param $article_id (int)
     * @return array $comments
     */
    public function getAllComments($article_id)
    {
        $db =  $this->dbConnect();
        $comments = $db->prepare('SELECT id, pseudo, comment, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM comments WHERE article_id = ? ORDER BY date_com DESC ');

        $comments->execute(array($article_id));
        
        return $comments->fetchAll();
    }


    /**
     * Add comments 
     * @param $article_id (int), $pseudo (var), $comment (text)
     * @return array $addLinesComment
     */
    public function getAddComments($article_id, $pseudo, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(article_id, pseudo, comment, date_com) VALUES (:article_id, :pseudo, :pseudo, NOW())');
        $addLinesComment = $comments->execute(array("article_id" => $article_id, "pseudo" => $pseudo, 'comment' => $comment)); 

        return $addLinesComment;
    }
}