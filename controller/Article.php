<?php 
namespace OpenClassrooms\Blog\Controller;

include_once 'model/ArticleManager.php';
include_once 'model/CommentManager.php';

class Article {
    public $article_id;
    
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
}