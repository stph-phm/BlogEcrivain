<?php
namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Session\FlashSession;
use mysql_xdevapi\Exception;

class Comments extends Controller {


    /**
     * Comments constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public function addComment()
    {
        if (!$this->isConnected) {
            header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article_id = $this->trim_secur($_GET['id']);
            $comment = $this->str_secur($_POST['comment']);
            $sessionId = $this->trim_secur($_SESSION['userId']);

            $articleManager = new ArticleManager();
            $article = $articleManager->getArticle($article_id);

            if (!$article) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                if (!empty($comment)) {
                    $commentManager = new CommentManager();
                    $addComment = $commentManager->addComment($comment, $article_id, $sessionId);

                    $flashSession = new FlashSession();
                    $flashSession->addFlash('success', 'Le commentaire est bien ajouté');
                }
                else {
                    $flashSession = new FlashSession();
                    $flashSession->addFlash('danger', "Veuillez remplir tous les champs !");
                }
            }
        }
        else {
            throw new Exception('Aucun identifiant de billet envoyé');

        }
        \header('Location: index.php?action=article&id='. $article_id);
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
            $commentById = $commentManager->getCommentById($comment_id);
            if (!$commentById) {
                throw new \Exception("Aucun identifiant de billet envoyé");
            }
            else {
                $commentReported = $commentManager->reportComment($comment_id);

                $flashSession = new FlashSession();
                $flashSession->addFlash('success', 'Le commentaire est bien signalé');
                \header('Location: index.php?action=article&id='.$commentById['article_id']);
            }
        } else {
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
            $commentById = $commentManager->getCommentById($comment_id);
            if (!$commentById) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                $commentManager->deleteComment($comment_id);

                $flashSession = new FlashSession();
                $flashSession->addFlash('info', 'Le commentaire est bien supprimé !');
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
            $commentById = $commentManager->getCommentById($comment_id);

            if (!$commentById) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                $commentManager->validateComReported($comment_id);

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
            $commentById = $commentManager->getCommentById($comment_id);

            if (!$commentById) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                $commentManager->deleteComment($comment_id);

                $flashSession = new FlashSession();
                $flashSession->addFlash('info', 'Le commentaire signalé est bien supprimé !');
                header('Location: index.php?action=dashboard');
            }
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }
}