<?php 

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;

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
     * show Article ($_get)
     */
    public function article()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $userManager = new UserManager();
        
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

        if($this->is_admin()) {
            if (isset($_POST['submit'])) {
                $title = $this->str_secur($_POST['title']);
                $content = $this->nl2br_secur($_POST['content']);
    
                if (!empty($title) && !empty($content)) {
                    $insertArticle = $articleManager->addArticle($title, $content);
                    
                    $_SESSION['successMsg'] = "Votre article est bien ajouté ! ";
                    

                    \header('Location: index.php?action=manageArticle');

                } else {
                    $errorMsg = "Veuillez remplir tous les champs ! ";
                }
                \header('Location: index.php?action=newArticle');
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
        $messageFlash = new MessageFlash();
        
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getId = $this->trim_secur($_GET['id']);
            $article = $articleManager->getArticle($getId);
            $isAdmin = $this->is_admin();

            if ($isAdmin) {
                if (isset($_POST['submit'])) {
                    $title = $this->str_secur($_POST['title']);
                    $content = $this->nl2br_secur($_POST['content']);

                    if (!empty($title) && !empty($content)) {
                        $edit = $articleManager->editArticle($getId, $title, $content);

                        header('Location: index.php?action=manageArticle');

                    } else {

                        $errorMsg = "Veuillez remplir tous les champs ! ";
                    }
                    header('Location: index.php?action=manageArticle');
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
 * 
 */
    public function deleteArticle()
    {
        $articleManager = new ArticleManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $getID = $this->trim_secur($_GET['id']);

            $deleteArticle = $articleManager->deleteArticle($getID);
            header('Location: index.php?action=manageArticle');
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