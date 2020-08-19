<?php 

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Session\FlashSession;


class Articles extends Controller {

    /**
     * Articles constructor.
     */
    public function __construct() {
        parent::__construct();
    }


    public function home()
    {
        $userManager = new UserManager();
        $articleManager = new ArticleManager();
        $lastArticles = $articleManager->listLastArticles();
        include 'view/Visitor/homeView.php';
    }

    /**
     * ASC
     */
    public function listArticles()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles();
        include 'view/Visitor/listArticlesView.php';
    }

    public function displayArticle()
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
        include 'view/Visitor/displayArticleView.php';
    }

    public function addArticle()
    {
        $articleManager = new ArticleManager();
        $flashSession = new FlashSession();

        if (!$this->isAdmin) {
            \header('Location: index.php');
        }

        $article_title = "";
        $content ="";

        if (isset($_POST['submit'])) {
            $article_title = $this->str_secur($_POST['title']);
            $content = $this->nl2br_secur($_POST['content']);

            if (!empty($article_title) && !empty($content)) {
                $insertArticle = $articleManager->addArticle($article_title, $content);

                $flashSession->addFlash('success', 'Votre article est ajouté!');

                header('Location: index.php?action=manageArticle');
            } else {
                $errorMsg = "Veuillez remplir tous les champs !";
            }
        }
        include 'view/Admin/createArticleView.php';
    }

    /**
     * ASC
     */
    public function manageArticle()
    {
        
        if (!$this->isAdmin) {
            header('Location: index.php');
        }
        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles();
        $i = 1;

        include 'view/Admin/listArticlesView.php';
    }

    public function editArticle()
    {
        $articleManager = new ArticleManager();
        $flashSession = new FlashSession();

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

                        $flashSession->addFlash('success', 'Votre article est bien modifié !');
                        header('Location: index.php?action=manageArticle');
                        
                    } else {
                        $errorMsg = 'Erreur ! Veuillez réessayer';
                    }
                }
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
        include 'view/Admin/editArticleView.php';
    }

    public function deleteArticle()
    {
        $articleManager = new ArticleManager();
        $flashSession = new FlashSession();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $article_id = $this->trim_secur($_GET['id']);

            $deleteArticle = $articleManager->deleteArticle($article_id);
            $flashSession->addFlash('info', 'Votre article est supprimé');

            header('Location: index.php?action=manageArticle');            
        } else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }
} 