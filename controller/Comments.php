<?php 
namespace App\Controller;

use App\Model\CommentManager;
use App\Controller\Controller;

class Comments extends Controller {
    public $article_id;
    public $pseudo;
    public $comment;
    public $comment_id;
    public $i;
    /**
     * Instantiating the CommentManager object
     * Check if we have received the ID in  parameter in the URL 
     * Check if the fiels are filled 
     * Call getAddComment method @param $_GET['id'], $_POST['pseudo'], $_POST['comment']
     */
    public function addComment()
    {
        $commentManager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            
            $article_id = trim($_GET['id']);
            $pseudo     = trim(htmlspecialchars($_POST['pseudo']));
            $comment    = trim(htmlspecialchars($_POST['comment']));

            if (!empty($pseudo) && !empty($comment)) {

                $addLinesComment = $commentManager->getAddComments($article_id, $pseudo, $comment);
                
                header('Location: index.php?action=article&id=' .$article_id);
            }
            else {
                throw new \Exception('Veuillez remplir les champs ');
            }
            if ($addLinesComment === false) {
                throw new \Exception('Impossible d\'ajouter les commentaires');
            } 
        }
    }

     // Signaler les commentaires 
    public function reportComment()
    {
        $commentManager = new CommentManager();
        if (isset($_POST['see'])) {
            die('OK');
        }
    }

    /**
     * Instantiating the CommentManager object
     * Check if we have received the ID in  parameter in the URL 
     * Call validateComment method @param  $comment_id
     */
    public function validateReportCom()
    {
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = trim($_GET['id']);

            $validateReport = $commentManager->validateComment($comment_id);
            header('Location: index.php?action=admin');
        }
    }

    /**
     * Instantiating the CommentManager object
     * Check if we have received the ID in  parameter in the URL 
     * Call deleteComments method @param  $comment_id
     */
    public function deleteReportCom()
    {
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = trim($_GET['id']);

            $deleteCom = $commentManager->deleteComments($comment_id);
            header('Location: index.php?action=admin');
        }
    }
}