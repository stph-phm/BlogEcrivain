<?php 

include_once 'model/ArticleManager.php';
include_once 'model/CommentManager.php';


class Frontend {
    public $article_id;
    public $pseudo;
    public $comment;

    /**
      * Instantiating the ArticleManager object
     * Call the getAllArticles method to display all articles 
     */
    public function allArticles()
    {
    $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
    $articles = $articleManager->getAllArticles();

    include 'view/frontend/allArticlesView.php';
    }

    /**
     * Instantiating the ArticleManager and CommentManager objects
     * Check if we have received an id parameter in the URL ($_GET['id])
     * If this is the cas, call  getArticle and getAllComments methods 
     */
    public function article()
    {
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article = $articleManager->getArticle($_GET['id']);
            $comments = $commentManager->getAllComments($_GET['id']);
        } 
        else {
            echo('Aucun identifiant de billet envoyé');
        }
        include 'view/frontend/articleView.php';
    }

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
                
                header('Location: index?php?action=article&id=' .$article_id);
            }
            else {
                echo 'Veuillez remplir les champs ';
            }
            if ($addLinesComment === false) {
                echo 'Impossible d\'ajouter les commentaires';
            } 
        }
    }
}

