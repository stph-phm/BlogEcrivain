<?php 

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Controller\Controller;


class Articles extends Controller {

    /**
      * Instantiating the ArticleManager object
     * Call the getAllArticles method to display all articles 
     */
    public function allArticles()
    {
    $articleManager = new ArticleManager();
    $listArticles = $articleManager->getAllArticles();
    
    include 'view/allArticlesView.php';
    }

    /**
     * Instantiating the ArticleManager and CommentManager objects
     * Check if we have received an id parameter in the URL ($_GET['id])
     * If this is the cas, call  getArticle and getAllComments methods 
     */
    public function article()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article_id = $this->trim_secur($_GET['id']);

            $article = $articleManager->getArticle($article_id);
            $listComments = $commentManager->getAllComments($article_id);
        } 
        else {
            throw new \Exception('Aucun identifiant de billet envoyé');
        }
        include 'view/articleView.php';   
    }
    

    public function createArticle()
    {
        $articleManager = new ArticleManager();

        if (isset($_POST['submit'])) {
            $title = $this->str_secur($_POST['title']);
            $content = $this->str_secur($_POST['content']);

            if (!empty($title) && !empty($content)) {
                $insertArticle = $articleManager->getAddArticle($title, $content);
                \header('Location: index.php?action=admin');
            } else {
                throw new \Exception("Veuillez remplir tous les champs ! ");
            }
        }
        include 'View/admin/createArticleView.php';
    }
    
    // Gestion des articles 
    // Ajouter, Voir, Modifier et supprimer un article

    public function manageArticle()
    {
        $articleManager = new ArticleManager();
        $allArticles = $articleManager->getAllArticles();

        $i = 1; 
        include 'view/admin/manageArticleView.php';
    }

    public function editArticle()
    {
        // Verifie si le button edit existe bien (dans le tableau admin)
        // affiche le formulaire avec le titre et content en session ? 
        // si les champs sont remplis 
        // lorsqu'on click sur $_POST['submit_edit'] => appels la méthode 
        // redirige le lien en adminView avec un message ? 
        $articleManager = new ArticleManager();
        
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getID = $this->trim_secur($_GET['id']); 
            $title = $this->str_secur($_POST['title']);
            $content = $this->str_secur($_POST['content']);

            if (!empty($title) && !empty($content)) {
                die('OK');
            }
        } throw new \Exception("Aucun identifiant de billet envoyé");
        
        include 'view/admin/editView.php';
        
    }

    public function deleteArticle()
    {
        $articleManager = new ArticleManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getID = $this->trim_secur($_GET['id']);

            $deleteArticle = $articleManager->getDeleteArticle($getID);
            header('Location: index.php?action=manageArticle');
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }
}