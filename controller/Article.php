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
        
    
    // Gestion des articles 
    // Ajouter, Voir, Modifier et supprimer un article
    public function addArticle() {

        // verifie si id est en paramètre de l'URL ? (vérifie si on a bien récupérer l'id en URL)
        // Lorsqu'on click sur le button create => vérifie si les champs sont bien remplis 
        // appelle la méthode pour aouter les nouveaux articles 
        // redirige le lien en adminView avec un message ? 
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_POST['add'])) {
            $articleManager->createArticle($_POST['title'], $_POST['content']);
            header('Location: index.php?action=addArticle');
        }
    }

    public function editArticle()
    {
        // Verifie si le button edit existe bien (dans le tableau admin)
        // affiche le formulaire avec le titre et content en session ? 
        // si les champs sont remplis 
        // lorsqu'on click sur $_POST['submit_edit'] => appels la méthode 
        // redirige le lien en adminView avec un message ? 
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                if ($_POST['edit']) {
                    $articleManager->editArticles($_GET['id'], $_POST['title'], $_POST['content']);
                    
                    header('Location: index.php?action=edit');
                }
            }
        }
        include 'model/frontend/editView.php';
    }

    public function deleteArticle()
    {
        // Vérifie si le button delete existe bien (dans le tableau admin)
        // appele la méthode et supprime l'article & les commentaires 
        // une alerte pour confirmer la supression ? 
        // redirige le lien en adminViex avec un message ? 
        $articleManager = new \OpenClassrooms\Blog\Model\ArticleManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (isset($_POST['deleteArticle'])) {
                $deleteComment->deleteArticle($_GET['id']);
            }
        }
    }
}