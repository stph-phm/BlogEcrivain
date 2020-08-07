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
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();

        include 'view/Visitor/homeView.php';
    }

    /**
     * Listing all Article ASC
     */
    public function listArticles()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles();
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include 'view/Visitor/listArticlesView.php';
    }

    /**
     * show Article ()
     */
    public function article()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article_id = $this->trim_secur($_GET['id']);
            $article = $articleManager->getArticle($article_id);
            $listComment = $commentManager->listComments($article_id);
        } 
        else {
            throw new \Exception('Aucun identifiant de billet envoyé');
        }
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
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

        if($this->is_admin()) {
            if (isset($_POST['submit'])) {
                $title = $this->str_secur($_POST['title']);
                $content = $this->nl2br_secur($_POST['content']);
    
                if (!empty($title) && !empty($content)) {
                    $insertArticle = $articleManager->addArticle($title, $content);

                    \header('Location: index.php?action=manageArticle');
                    $flashSession->set('success', 'L\'article est bien ajouté !');
                    
                
                } else {
                    \header('Location: index.php?action=newArticle');
                    $flashSession->set('error', 'Veuillez remplir tous les champs !');
                    
                }
            }
        } else {
            header('Location: index.php');
        }
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include 'view/Admin/createArticleView.php';
    }
    
    // Gestion des articles 
    // test s'il est admin => peut faire la gestion sinon => envoie header
    // Voir, Modifier et supprimer un article
    public function manageArticle()
    {
        if($this->is_admin()) {
            $articleManager = new ArticleManager();
            $articles = $articleManager->listArticles();
            $i = 1; 
        } else {
            \header('Location: index.php');
        }
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        include 'view/Admin/manageArticleView.php';
    }


    /**
     * Modifier un article
     */
    public function editArticle()
    {
        $articleManager = new ArticleManager();
        $flashSession = new FlashSession();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $article_id = $this->trim_secur($_GET['id']);
            $article = $articleManager->getArticle($article_id);
            $isAdmin = $this->is_admin();

            if ($isAdmin) {
                if (isset($_POST['submit'])) {
                    $title = $this->str_secur($_POST['title']);
                    $content = $this->nl2br_secur($_POST['content']);

                    if (!empty($title) && !empty($content)) {
                        $edit = $articleManager->editArticle($article_id, $title, $content);

                        header('Location: index.php?action=manageArticle');
                        $flashSession->set('success', 'Votre article est bien modifié !');
                        
                    } else {
                        header('Location: index.php?action=edit&id=' . $article_id);
                        $flashSession->set('error', 'Erreur ! Veuillez réessez !');
                    }
                }
            }else {
                \header('Location: index.php');
            }
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }

        $isConnected = $this->is_connected();

        include 'view/Admin/editView.php';
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
        $userInfo = $this->userInfo;
        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();

        include 'view/Include/nav.php';
    }
} 