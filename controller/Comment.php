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
    public function addComment()
    {
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
        $article_id = trim($_GET['id']);
        $pseudo     =   trim(htmlspecialchars($_POST['pseudo']));
        $comment    = trim(htmlspecialchars($_POST['comment']));

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
                $addLinesComment = $commentManager->getAddComments($article_id, $pseudo, $comment);
                
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
                $article_id = 
                $reportComment = $commentManager->reportComments($_GET['id'], $_POST['report']);

            header('Location: index.php?action=article&id=' .$article_id);
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
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
        if (isset($_POST['ignore'])) {
            $ignored = $commentManager->ignoreComments($comment_id);

            header('Location: index.php?action=admin');
        }

        // Vérifie si le button delete comment existe
        // lorsqu'on click sur le button delete => supprime le commentaire 
        // redirige le lien tableau de bord ? 
        if (isset($_POST['deleteComment'])) {
            $deleteComment = $commentManager->deleteComments($comment_id);
            
            header('Location: index.php?action=admin');
        }
        include 'view/frontend/adminView.php';
    }


}