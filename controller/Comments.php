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
        $isConnected = $this->is_connected();
        
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getId = $this->trim_secur($_GET['id']);
            $comment = $this->str_secur($_POST['comment']);
            $sessionId = $this->trim_secur($_SESSION['userId']);

            if (!empty($comment)) {
                $addLinesComment = $commentManager->addComment($comment, $getId, $_SESSION['userId']);
                \header('Location: index.php?action=article&id='.$getId);
            } else {
                throw new \Exception("Veuillez remplir tous les champs ! ");
                
            }
            //Afficher l'username dans input pseudo pour ajouter le commentaire 
            //$sessionId = $this->trim_secur($_SESSION['userId']);
            //$userInfo = $userManager->getUserById($sessionId);

        } 
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

     // Signaler les commentaires 
    public function reportComment()
    {
        $isAdmin = $this->is_admin();
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
        $isAdmin = $this->is_admin();
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
        $isAdmin = $this->is_admin();
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);

            $deleteCom = $commentManager->deleteComment($comment_id);
            header('Location: index.php?action=admin');
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

        public function dashboard()
    {
        $isAdmin = $this->is_admin();
        $commentManager = new CommentManager();
        $listCommentsReport = $commentManager->getAllReported();
        $i = 1;
        include 'View/admin/adminView.php';
    }
}