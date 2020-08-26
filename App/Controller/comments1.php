<?php
namespace App\Controller;


use App\Model\CommentManager;
use App\Session\FlashSession;


class Comments extends Controller {

    public $comment;


    /**
     * Comments constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public function addComment()
    {
        if (!$this->isConnected) {
            \header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment_id = $this->trim_secur($_GET['id']);
            $comment = $this->trim_secur($this->str_secur($_POST['comment']));
            $sessionId = $this->trim_secur($_SESSION['userId']);

            $commentManager = new CommentManager();
            $listComments = $commentManager->listComments($comment_id);

            if (!$listComments) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                if (!empty($comment)) {
                    $commentManager = new CommentManager();
                    $commentManager->addComment($comment, $comment_id, $sessionId);

                    $flashSession = new FlashSession();
                    $flashSession->addFlash('success', 'Le commentaire est bien ajouté');
                }
                else {
                    $errorMsg = "Veuillez remplir tous les champs !";
                }
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
        if (!$this->isAdmin) {
            header('Location: index.php');
        }

        $commentManager = new CommentManager();
        $reportedComments = $commentManager->listReportedCom();
        $i = 1;

        include 'view/Admin/dashboardView.php';
    }


    public function reportComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment_id = $this->trim_secur($_GET['id']);

            $commentManager = new CommentManager();
            $reportCommentId = $commentManager->reportComment($comment_id);

            if ($reportCommentId) {
                throw new \Exception("Aucun identifiant de billet envoyé");
            }
            else {
                $flashSession = new FlashSession();
                $flashSession->addFlash('info', 'Le commentaire est signalé');

                $commentById = $commentManager->getCommentById($comment_id);
                \header('Location: index.php?action=article&id='.$commentById['article_id']);
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    public function deleteComment()
    {
        if (!$this->isAdmin) {
            \header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment_id = $this->trim_secur($_GET['id']);

            $commentManager = new CommentManager();
            $deleteComment = $commentManager->deleteComment($comment_id);

            if (!$deleteComment) {
                throw new \Exception("Aucun identifiant de billet envoyé");
            }
            else {
                $flashSession = new FlashSession();
                $flashSession->addFlash('info', 'Le commentaire signalée est bien supprimé !');
                $commentById = $commentManager->getCommentById($comment_id);
                \header('Location: index.php?action=article&id='.$commentById['article_id']);
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    public function validateReportCom()
    {
        if (!$this->isAdmin) {
            \header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);
            $commentManager = new CommentManager();
            $validateComment = $commentManager->validateComReported($comment_id);
            if (!$validateComment) {
                throw new \Exception("Aucun identifiant de billet envoyé");
            }
            else {
                $flashSession = new FlashSession();
                $flashSession->addFlash('success', 'Le commentaire signalée est bien validé');
                header('Location: index.php?action=dashboard');
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    public function deleteReportCom()
    {
        if (!$this->isAdmin) {
            \header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $comment_id = $this->trim_secur($_GET['id']);
            $commentManager = new CommentManager();
            $deleteReportComment = $commentManager->deleteComment($comment_id);

            if (!$deleteReportComment) {
                throw new \Exception("Aucun identifiant de billet envoyé");
            }
            else {
                $flashSession = new FlashSession();
                $flashSession->addFlash('info', 'Le commentaire signalé est bien supprimé !');
                header('Location: index.php?action=dashboard');
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }
}