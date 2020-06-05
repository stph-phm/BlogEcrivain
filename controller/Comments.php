<?php 
namespace App\Controller;

use App\Model\UserManager;
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
        $userManager = new UserManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getID = $this->trim_secur($_GET['id']);
            $comment = $this->str_secur($_POST['comment']);
            $pseudo =$this->str_secur($_POST['pseudo']);

            $userInfo = $userManager->getUserById($pseudo);
            
            if (!empty($comment)) {
                $addLinesComment = $commentManager->addNewComment($comment, $getID, $userInfo);

                if ($addLinesComment === true) {
                    \header('Location: index.php?action=article&id='.$getID);
                } 
                else {
                    throw new \Exception("Impossible d'ajouter le commentaire !");
                }
            } 
            else {
                throw new \Exception("Veuillez remplir tous les champs ! ");
            }
        } 
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

     // Signaler les commentaires 
    public function reportComment()
    {
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getId = $this->trim_secur($_GET['id']);

            $commentReported = $commentManager->reportComment($getId);
            // $comment = $commentManager->getCommentById($getId);
            \header('Location: index.php?action=article&id=' .$getId);
            
        } 

    }

    public function validateReportCom()
    {
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);

            $validateReport = $commentManager->validateReport($comment_id);
            header('Location: index.php?action=admin');
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    public function deleteReportCom()
    {
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);

            $deleteCom = $commentManager->deleteComment($comment_id);
            header('Location: index.php?action=admin');
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }
}