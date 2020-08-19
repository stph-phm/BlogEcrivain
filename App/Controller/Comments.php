<?php 
namespace App\Controller;


use App\Model\CommentManager;
use App\Session\FlashSession;


class Comments extends Controller {
    public $article_id;
    public $pseudo;
    public $comment;
    public $comment_id;

    /**
     * Comments constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public function addComment()
    {
        $commentManager = new CommentManager();
        $flashSession = new FlashSession();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment_id = $this->trim_secur($_GET['id']);
            $comment = $this->str_secur($_POST['comment']);
            $sessionId = $this->trim_secur($_SESSION['userId']);

            if (!empty($comment)) {
                $addComment = $commentManager->addComment($comment, $comment_id, $sessionId);
                $flashSession->addFlash('success', 'Le commentaire est bien ajouté');
            }
            else {
                $errorMsg = "Veuillez remplir tous les champs !";
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
        \header('Location: index.php?action=article&id='. $comment_id);
    }

    /*
     * ASC
     */
    public function listReportComments() {
        $commentManager = new CommentManager();
        if (!$this->isAdmin) {
            header('Location: index.php');
        }
        $reportedComments = $commentManager->listReportedCom();
        $i = 1;

        include 'view/Admin/dashboardView.php';
    }

     // Signaler les commentaires 
    public function reportComment()
    {
        $commentManager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment_id = $this->trim_secur($_GET['id']);

            $commentReported = $commentManager->reportComment($comment_id);
            $commentById = $commentManager->getCommentById($comment_id);

            \header('Location: index.php?action=article&id='.$commentById['article_id']);
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    public function deleteComment()
    {
        $commentManager = new CommentManager();
        $flashSession = new FlashSession();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment_id = $this->trim_secur($_GET['id']);

            $commentById = $commentManager->getCommentById($comment_id);
            $deleteCom = $commentManager->deleteComment($comment_id);

            $flashSession->addFlash('info', 'Le commentaire signalée est bien supprimé !');
            \header('Location: index.php?action=article&id='.$commentById['article_id']);
        }else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    public function validateReportCom()
    {
        $commentManager = new CommentManager();
        $flashSession = new FlashSession();

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);
            $validateReport = $commentManager->validateComReported($comment_id);

            $flashSession->addFlash('success', 'Le commentaire signalée est bien validé');
            header('Location: index.php?action=dashboard');
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    public function deleteReportCom()
    {
        $commentManager = new CommentManager();
        $flashSession = new FlashSession();

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);
            $deleteCom = $commentManager->deleteComment($comment_id);

            $flashSession->addFlash('info', 'Le commentaire signalé est bien supprimé !');
            header('Location: index.php?action=dashboard');
            
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }
}