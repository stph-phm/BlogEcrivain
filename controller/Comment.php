<?php 
namespace OpenClassrooms\Blog\Controller;

include_once 'model/ArticleManager.php';
include_once 'model/CommentManager.php';

class Comment {
    public $article_id;
    public $pseudo;
    public $comment;
    public $comment_id;
    /**
     * Instantiating the CommentManager object
     * Check if we have received the ID in  parameter in the URL 
     * Check if the fiels are filled 
     * Call getAddComment method @param $_GET['id'], $_POST['pseudo'], $_POST['comment']
     */
    public function addComment($article_id, $pseudo, $comment)
    {
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
                
                $addLinesComment = $commentManager->getAddComments($_GET['id'], $_POST['pseudo'], $_POST['comment']);
                
                header('Location: index.php?action=article&id=' .$article_id);
            }
            else {
                echo 'Veuillez remplir les champs ';
            }
            if ($addLinesComment === false) {
                echo 'Impossible d\'ajouter les commentaires';
            } 
        }
    }

     // Signaler les commentaires 
    public function reportComment($comment_id, $article_id)
    {

        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            if (isset($_POST['report'])) {
                $reportComment = $commentManager->reportComments($_GET['id'], $_POST['report']);

            header('Location: index.php?action=article&id=' .$article_id);
            }
            

        }
    }

}