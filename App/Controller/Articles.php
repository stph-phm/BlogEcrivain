<?php 

namespace App\Controller;

use App\Message\FlashMessage;
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
        $flashMessage = new FlashMessage();


        if($this->is_admin()) {
            if (isset($_POST['submit'])) {
                $title = $this->str_secur($_POST['title']);
                $content = $this->nl2br_secur($_POST['content']);
    
                if (!empty($title) && !empty($content)) {
                    $insertArticle = $articleManager->addArticle($title, $content);
                    $flashMessage->setSuccessMsg('Votre article est bien ajouté !');

                    \header('Location: index.php?action=manageArticle');
                    $displayMsg = $flashMessage->displayMsg();

                } else {
                    $flashMessage->setErrorMsg('Veuillez remplir tous les champs !');
                    \header('Location: index.php?action=newArticle');
                    $displayMsg = $flashMessage->displayMsg();
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
        $flashMessage = new FlashMessage();

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
                        $flashMessage->setSuccessMsg('Votre article a bien été modifié !');

                    } else {
                        header('Location: index.php?action=edit&id=' . $article_id);
                        $flashMessage->setErrorMsg('Veuillez remplir tous les champs pour pouvoir modifier votre article !');
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
        $flashMessage = new FlashMessage();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $article_id = $this->trim_secur($_GET['id']);

            $deleteArticle = $articleManager->deleteArticle($article_id);
            header('Location: index.php?action=manageArticle');
            $flashMessage->setSuccessMsg("Votre article est bien été supprimer !");

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