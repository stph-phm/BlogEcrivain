<?php
namespace App\Model;

use App\Model\Manager;

class CommentManager extends Manager
{
    public $comment_id;
    public $comment;
    public $date_com;
    public $reported;
    public $article_id;
    public $user_id;

    /**
     * @param $article_id
     * @return array
     */
    public function listComments($article_id)
    {
        $db =  $this->dbConnect();
        $reqComment = $db->prepare('
            SELECT comments.id, users.username as pseudo, comment, reported, date_comment, article_id, user_id 
            FROM comments 
            INNER JOIN users 
            ON comments.user_id = users.id 
            WHERE article_id = :article_id
            ORDER BY date_comment DESC ');

        $reqComment->execute([
            'article_id' => $article_id
        ]);
        return $listComment = $reqComment->fetchAll();
    }


    /**
     * Add comment
     * @param $comment
     * @param $article_id
     * @param $user_id
     * @return bool
     */
    public function addComment($comment, $article_id, $user_id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
            INSERT INTO comments(comment,reported, date_comment, article_id, user_id) 
            VALUES (:comment, 0, NOW(), :article_id, :user_id)');

        return $addComment = $comments->execute([
            'comment' => $comment,
            'article_id' => $article_id,
            'user_id' => $user_id
        ]);

    }

    /**
     * @param $comment_id
     * @return mixed
     */
    public function getCommentById($comment_id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare('
            SELECT * 
            FROM comments 
            WHERE id = ?
        ');
        $reqComment ->execute([
            'id' => $comment_id
        ]);
        return $commentById = $reqComment->fetch();
    }


    /**
     * Report comments 
     * @param $comment_id (int)
     */
    public function reportComment($comment_id)
    {

        $db = $this->dbConnect();
        $reqComment = $db->prepare('
            UPDATE comments 
            SET reported = 1 
            WHERE id = :id');

        $commentReported = $reqComment->execute([
            'id' => $comment_id
        ]);
    }


    /**
     * Get all report comments 
     * @return $reqComment
     */
    public function listReportedCom()
    {
        $db = $this->dbConnect();
        $reqComment = $db->query('
            SELECT comments.id, users.username as pseudo, comment, reported, date_comment, article_id, user_id 
            FROM comments 
            INNER JOIN users 
            ON comments.user_id = users.id 
            WHERE reported = 1');

        return  $reportedComments = $reqComment->fetchAll();
    }


    /**
     * Ignore comment report
     * @param $comment_id (int)
     */
    public function validateComReported($comment_id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare(
            'UPDATE comments 
            SET reported = 0 
            WHERE id = :id');

        $validateReport =  $reqComment->execute([
            'id' => $comment_id
        ]);
    }

    /**
     * Delete comments 
     * @param $comment_id (int)
     */
    public function deleteComment($comment_id)
    {
        $db = $this->dbConnect();
        $reqComment = $db->prepare(
            'DELETE FROM comments 
            WHERE id = :id');
        
        $deleteCom = $reqComment->execute([
            'id' => $comment_id
        ]);
    }
}