<?php 
namespace App\Controller;

use App\Model\UserManager;
use App\Model\CommentManager;


class Comments extends Controller {
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
                $addComment = $commentManager->addComment($comment, $getId, $_SESSION['userId']);
            } else {
                throw new \Exception("Veuillez remplir tous les champs !");
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }

        \header('Location: index.php?action=article&id='.$getId);
    }

    public function dashboard() {
        $commentManager = new CommentManager();

        if ($this->is_admin()) {
            $reportedComments = $commentManager->listReportedCom();
            $i = 1;
        } else {
            \header("Location: index.php");
        }
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include 'view/Admin/dashboardView.php';
    }

     // Signaler les commentaires 
    public function reportComment()
    {
        $isAdmin = $this->is_admin();
        $commentManager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getId = $this->trim_secur($_GET['id']);

            $commentReported = $commentManager->reportComment($getId);
            $commentById = $commentManager->getCommentById($getId);
            \header('Location: index.php?action=article&id='.$commentById['article_id']);
        }
    }

    public function validateReportCom()
    {
        $isAdmin = $this->is_admin();
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);

            $validateReport = $commentManager->validateComReported($comment_id);
            header('Location: index.php?action=dashboard');
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
}