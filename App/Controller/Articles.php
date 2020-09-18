<?php 

namespace App\Controller;

use App\Model\UserManager;
use App\Model\ArticleManager;
use App\Model\CommentManager;
use App\Session\FlashSession;
use App\Controller\Controller;

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
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article_id = $this->trim_secur($_GET['id']);

            $articleManager = new ArticleManager();
            $article = $articleManager->getArticle($article_id);

            if (!$article) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                $commentManager = new CommentManager();
                $listComment = $commentManager->listComments($article_id);
            }
        } 
        else {
            throw new \Exception('Aucun identifiant de billet envoyé');
        }
        include 'view/Visitor/displayArticleView.php';
    }

    public function addArticle()
    {
        if (!$this->isAdmin) {
            \header('Location: index.php');
        }

        $article_title = "";
        $content ="";

        if (isset($_POST['submit'])) {
            $article_title = $this->str_secur($_POST['title']);
            $content = $this->trim_secur($this->nl2br_secur($_POST['content']));

            if (!empty($article_title) && !empty($content)) {
                $articleManager = new ArticleManager();
                $articleManager->addArticle($article_title, $content);

                $flashSession = new FlashSession();
                $flashSession->addFlash('success', 'Votre article est ajouté!');

                header('Location: index.php?action=manageArticle');
            } 
            else {
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

    // Only administrator
    public function editArticle()
    {
        if (!$this->isAdmin) {
            \header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            $article_id = $this->trim_secur($_GET['id']);

            $articleManager = new ArticleManager();
            $article = $articleManager->getArticle($article_id);
            //is not
            if (!$article) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                $article_title = $article['title'];
                $content = $article['content'];

                if (isset($_POST['submit'])) {
                    $article_title = $this->str_secur($_POST['title']);
                    $content = $this->trim_secur($this->nl2br_secur($_POST['content']));

                    if (!empty($article_title) && !empty($content)) {
                        $articleManager = new ArticleManager();
                        $articleManager->editArticle($article_id, $article_title, $content);

                        $flashSession = new FlashSession();
                        $flashSession->addFlash('success', 'Votre article est bien modifié !');
                        header('Location: index.php?action=manageArticle');
                    }
                    else {
                        $errorMsg = 'Erreur Veuillez réessayer !';
                    }
                }
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }

        include 'view/Admin/editArticleView.php';
    }

    // Only administrators
    public function deleteArticle()
    {
        if (!$this->isAdmin) {
            header('Location: index.php');
        }

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $article_id = $this->trim_secur($_GET['id']);

            $articleManager = new ArticleManager();
            $article = $articleManager->getArticle($article_id);

            // is not
            if (!$article) {
                throw new \Exception('Aucun identifiant de billet envoyé');
            }
            else {
                $articleManager->deleteArticle($article_id);

                $flashSession = new FlashSession();
                $flashSession->addFlash('info', 'Votre article est supprimé');

                header('Location: index.php?action=manageArticle');
            }
        }
        else {
            throw new \Exception("Aucun identifiant de billet envoyé");
        }
    }
} 