<?php 

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Session\FlashSession;


class Articles extends Controller {

    /**
      * Show Home
     */
    public function home()
    {
        $userManager = new UserManager();
        $articleManager = new ArticleManager();
        $lastArticles = $articleManager->listLastArticles();
        parent::__construct();

        include 'view/Visitor/homeView.php';
    }

    /**
     * Listing all Article ASC
     */
    public function listArticles()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles();
        parent::__construct();
        include 'view/Visitor/listArticlesView.php';
    }

    /**
     * show Article ()
     */
    public function displayArticle()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        parent::__construct();
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article_id = $this->trim_secur($_GET['id']);
            $article = $articleManager->getArticle($article_id);
            $listComment = $commentManager->listComments($article_id);
        } 
        else {
            throw new \Exception('Aucun identifiant de billet envoyé');
        }

        include 'view/Visitor/articleView.php';
    }

    /**
     * Ajouter un article 
     * Instanciation de l'ArticleMAnager
     * 
     */
    public function addArticle()
    {
        $articleManager = new ArticleManager();
        $flashSession = new FlashSession();
        parent::__construct();

        if (!$this->is_admin()) {
            \header('Location: index.php');
        }

        $article_title = "";
        $content ="";

        if (isset($_POST['submit'])) {
            $article_title = $this->str_secur($_POST['title']);
            $content = $this->nl2br_secur($_POST['content']);

            if (!empty($article_title) && !empty($content)) {
                $insertArticle = $articleManager->addArticle($article_title, $content);

                $flashSession->set('success', 'L\'article est bien ajouté');
                header('Location: index.php?action=manageArticle');
            } else {
                $errorMsg = "Veuillez remplir tous les champs !";
            }
        }

        include 'view/Admin/createArticleView.php';
    }
    
    // Gestion des articles 
    // test s'il est admin => peut faire la gestion sinon => envoie header
    // Voir, Modifier et supprimer un article
    public function manageArticle()
    {
        parent::__construct();
        if (!$this->isAdmin) {
            header('Location: index.php');
        }
        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles();
        $i = 1;

        include 'view/Admin/listArticlesAdminView.php';
    }


    /**
     * Modifier un article
     */
    public function editArticle()
    {
        $articleManager = new ArticleManager();
        $flashSession = new FlashSession();
        parent::__construct();

        if (!$this->isAdmin) {
            \header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $article_id = $this->trim_secur($_GET['id']);
            $article = $articleManager->getArticle($article_id);

            $article_title = $article['title'];
            $content = $article['content'];

            if (isset($_POST['submit'])) {
                    $article_title = $this->str_secur($_POST['title']);
                    $content = $this->nl2br_secur($_POST['content']);

                    if (!empty($title) && !empty($content)) {
                        $edit = $articleManager->editArticle($article_id, $article_title, $content);

                        $flashSession->set('success', 'Votre article est bien modifié !');
                        header('Location: index.php?action=manageArticle');
                        
                    } else {
                        $flashSession->set('error', 'Erreur ! Veuillez réessez !');
                    }
                }
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
        include 'view/Admin/editArticleView.php';
    }

/**
 * Delete article
 */
    public function deleteArticle()
    {
        $articleManager = new ArticleManager();
        $flashSession = new FlashSession();
        

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $article_id = $this->trim_secur($_GET['id']);

            $deleteArticle = $articleManager->deleteArticle($article_id);
            header('Location: index.php?action=manageArticle');
            $flashSession->set('info', 'Votre article est supprimé');
            
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }

    /**
     * List all article in the Nav
     */
    public function listArticleNav()
    {
        parent::__construct();
        include 'view/Include/nav.php';
    }
} 