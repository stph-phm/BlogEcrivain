<?php
namespace App\Model;

use App\Model\Manager;

class CommentManager extends Manager
{
    public $id;
    public $comment;
    public $date_com;
    public $reported;
    public $article_id;
    public $user_id;

    /**
     * Get all comments in database in comments
     * @param $article_id (int)
     * @return array $comments
     */
    public function getListComment($article_id)
    {
        $db =  $this->dbConnect();
        $reqComment = $db->prepare(
            'SELECT comments.id, users.username as pseudo, comment, reported, date_comment, article_id, user_id 
            FROM comments 
            INNER JOIN users 
            ON comments.user_id = users.id 
            WHERE article_id = ?
            ORDER BY date_comment DESC ');

        $reqComment->execute([$article_id]);

        $listComment = $reqComment->fetchAll();
        return $listComment;
    }


    /**
     * Add comments 
     * @param $comment, $article_id, $user_id
     * @return array $addLinesComment
     */
    public function addComment($comment, $article_id, $user_id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare(
            'INSERT INTO comments(comment,reported, date_comment, article_id, user_id) 
            VALUES (:comment, 0, NOW(), :article_id, :user_id)');

        $addLinesComment = $comments->execute([
            'comment' => $comment,
            'article_id' => $article_id,
            'user_id' => $user_id
            ]); 

        return $addLinesComment;
    }

    //getcommentbyid 
    public function getCommentById($id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->query(
            'SELECT * 
            FROM comments 
            WHERE article_id = ?');
            
        $reqComment->execute([$id]);
        $commentById = $reqComment->fecth();

        return $commentById;
    }
    

    /**
     * Report comments 
     * @param $comment_id (int)
     */
    public function reportComment($id)
    {

        $db = $this->dbConnect();
        $reqComment = $db->prepare(
            'UPDATE comments 
            SET reported = 1 
            WHERE id = ?');
        $commentReported = $reqComment->execute([$id]);
    }


    /**
     * Get all report comments 
     * @return $reqComment
     */
    public function getAllReported()
    {
        $db = $this->dbConnect();
        $reqComment = $db->query(
            'SELECT comments.id, users.username as pseudo, comment, reported, date_comment, article_id, user_id 
            FROM comments 
            INNER JOIN users 
            ON comments.user_id = users.id 
            WHERE reported = 1');

        $listCommentsReport = $reqComment->fetchAll();

        return $listCommentsReport;
    }


    /**
     * Ignore comment report
     * @param $comment_id (int)
     */
    public function validateReport($id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare(
            'UPDATE comments 
            SET reported = 0 
            WHERE id = ?');

        $validateReport =  $reqComment->execute([$id]);
    }

    /**
     * Delete comments 
     * @param $comment_id (int)
     */
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare(
            'DELETE FROM comments 
            WHERE id = ?');
        
        $deleteCom = $reqComment->execute([$id]);
    }
}