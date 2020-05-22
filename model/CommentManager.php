<?php
namespace App\Model;

use App\Model\Manager;

include_once 'model/Manager.php';

class CommentManager extends Manager
{
    public $id;
    public $pseudo;
    public $comment;
    public $date_com;
    public $reported;
    public $article_id;

    /**
     * Get all comments in database in comments
     * @param $article_id (int)
     * @return array $comments
     */
    public function getAllComments($article_id)
    {
        $db =  $this->dbConnect();
        $comments = $db->prepare('SELECT id, pseudo, comment, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM comments WHERE article_id = :article_id ORDER BY date_com DESC ');

        $comments->execute([
            'article_id' => $article_id]);
        
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
        $comments = $db->prepare('INSERT INTO comments(article_id, pseudo, comment, date_com) VALUES (:article_id, :pseudo, :comment, NOW())');

        $addLinesComment = $comments->execute([
            "article_id" => $article_id, 
            "pseudo" => $pseudo, 
            'comment' => $comment
            ]); 

        return $addLinesComment;
    }

    /**
     * Report comments 
     * @param $comment_id (int)
     */
    public function reportComments($article_id, $reported )
    {

        $db = $this->dbConnect();
        $reqComment = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $reqComment->execute([
            'id' => $article_id,
            'reported' => $reported
        ]);
    }


    /**
     * Get all report comments 
     * @return $reqComment
     */
    public function getAllReported()
    {
        $db = $this->dbConnect();
        $reqComment = $db->query('SELECT * FROM comments WHERE reported = 1');

        $listCommentsReport = $reqComment->fetchAll();

        return $listCommentsReport;
    }


    /**
     * Ignore comment report
     * @param $comment_id (int)
     */
    public function validateComment($id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');

        $validateReport =  $reqComment->execute([$id]);

    }

    /**
     * Delete comments 
     * @param $comment_id (int)
     */
    public function deleteComments($id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare('DELETE FROM comments WHERE id = ?');
        
        $deleteCom = $reqComment->execute([$id]);
    }
}