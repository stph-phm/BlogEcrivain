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
        $reqComment = $db->prepare('SELECT id, pseudo, comment,  reported, date_comment FROM comments WHERE article_id = ? ORDER BY date_comment DESC ');
        
        $reqComment->execute([$article_id]);

        $listComments = $reqComment->fetchAll();
        
        return $listComments;
    }



    /**
     * Add comments 
     * @param $article_id (int), $pseudo (var), $comment (text)
     * @return array $addLinesComment
     */
    public function getAddComments($pseudo, $comment, $article_id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(pseudo, comment,reported, date_comment, article_id) VALUES (:pseudo, :comment, 0, NOW(), :article_id)');

        $addLinesComment = $comments->execute([
            'pseudo' => $pseudo,
            'comment' => $comment,
            'article_id' => $article_id
            ]); 

        return $addLinesComment;
    }


    /**
     * Report comments 
     * @param $comment_id (int)
     */
    public function getReportComments($id)
    {

        $db = $this->dbConnect();
        $reqComment = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $commentReported = $reqComment->execute([$id]);
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
    public function getValidateComment($id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');

        $validateReport =  $reqComment->execute([$id]);
    }

    /**
     * Delete comments 
     * @param $comment_id (int)
     */
    public function getDeleteComments($id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare('DELETE FROM comments WHERE id = ?');
        
        $deleteCom = $reqComment->execute([$id]);
    }
}