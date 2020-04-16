<?php
namespace OpenClassrooms\Blog\Model;

include_once 'model/Manager.php';

class CommentManager extends Manager
{
    public function getAllComments($article_id)
    {
        $db =  $this->dbConnect();
        $comments = $db->prepare('SELECT id, pseudo, comment, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM comments WHERE article_id = ? ORDER BY date_com DESC ');

        $comments->execute(array($article_id));
        return $comments;
    }

    public function getAddComments($article_id, $pseudo, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(article_id, pseudo, comment, date_com) VALUES (?, ?, ?, NOW())');
        $addLinesComment = $comments->execute(array($article_id, $pseudo, $comment)); 

        return $addLinesComment;
    }
}