<?php 
namespace App\Blog\Controller;
use App\Blog\Model\CommentManager;

include_once 'model/ArticleManager.php';
include_once 'model/CommentManager.php';

class Comments {
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
        $article_id = trim($_GET['id']);
        $pseudo     = trim(htmlspecialchars($_POST['pseudo']));
        $comment    = trim(htmlspecialchars($_POST['comment']));

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
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
        $article_id = trim($_GET['id']); 
        $reported   = $_POST['report'];
        $allComments['reported'] = null; 

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            if (isset($_POST['report'])) {
                if ($allComments == 0) {
                    $reportComment = $commentManager->reportComments($article_id, $reported);
                }

                header('Location: index.php?action=article&id=' .$article_id);
            }
        }
    }

    public function validateReportCom()
    {
        $commentManager = new CommentManager();
        $validate = $_POST['validate']; 


        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            if (isset($validate)) {
                $commentManager->validateComment($comment_id);
            }
        }
    }


   // Gestion des commentaires signalée
    // ignorer ou supprimer les commentaires signalés
    public function managerReportComment()
    {
        // verifie si le button ignore existe 
        // lorsqu'on click sur le button ignore => le commentaire ignorer ne sera plus signalé (il s'affiche plus dans le tableau)
        // redirige le lien tableau de bord ? 
        $commentManager = new CommentManager();
        if (isset($_POST['report'])) {
            $commentManager->ignoreComments($comment_id, $reported);
        }
        

            header('Location: index.php?action=admin');

        // Vérifie si le button delete comment existe
        // lorsqu'on click sur le button delete => supprime le commentaire 
        // redirige le lien tableau de bord ? 
        include 'view/adminView.php';
    }


}