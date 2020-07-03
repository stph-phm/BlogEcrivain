<?php 

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Controller\Controller;


class Articles extends Controller {
    /**
      * Instantiating the ArticleManager object
     * Call the getAllArticles method to display all articles 
     */
    public function latestArticle()
    {
    $articleManager = new ArticleManager();
    // $listArticle = $articleManager->getAllArticles();
    $newArticle = $articleManager->getNewArticle();
        include 'view/homeView.php';
    }

    public function allArticle()
    {
        $articleManager = new ArticleManager();
        $listArticle = $articleManager->getAllArticles();
        include 'view/allArticle.php';
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
        $userManager = new UserManager();
        
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article_id = $this->trim_secur($_GET['id']);
            $article = $articleManager->getArticle($article_id);
            $listComment = $commentManager->getListComment($article_id);
        } 
        else {
            throw new \Exception('Aucun identifiant de billet envoyé');
        }
        include 'view/articleView.php';   
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
                    \header('Location: index.php?action=manageArticle');
                } else {
                    throw new \Exception("Veuillez remplir tous les champs ! ");
                }
            }
        } else {
            header('Location: index.php');
        }

        
        include 'view/Admin/createArticleView.php';
    }
    
    // Gestion des articles 
    // test s'il est admin => peut faire la gestion sinon => envoie header
    // Voir, Modifier et supprimer un article
    public function manageArticle()
    {
        $isAdmin  = $this->is_admin();

        if(isset($isAdmin)) {
            $articleManager = new ArticleManager();
            $listArticle = $articleManager->getAllArticles();
            $i = 1; 
        } else {
            \header('Location: index.php');
        }
        include 'view/Admin/manageArticleView.php';
    }

    public function dashboard() {
        if ($this->is_admin()) {
        $listCommentsReport = $commentManager->getAllReported();
        $i = 1;
        } else {
            \header("Location: index.php");
        }

        

        include 'view/Admin/dashboardView.php';
    }
    /**
     * Modifier un article
     */
    public function editArticle()
    {
        $articleManager = new ArticleManager();
        
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
                        throw new \Exception("Veuillez remplir tous les champs ! ");
                    }
                }
            }else {
                \header('Location: index.php');
            }
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
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

        $isConnected = $this->is_connected();
        $isAdmin = $this->is_admin();
        $articleManager = new ArticleManager();
        $userManager = new UserManager();

        $listArticle = $articleManager->getAllArticles();
        $userInfo = $userManager->getUserById($_SESSION['userId']);
        
        include 'view/Include/nav.php';
    }
}