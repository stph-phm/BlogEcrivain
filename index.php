<?php 
include 'controller/frontend.php';

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'allArticles') {
        allArticles();
    } 
    elseif ($_GET['action'] == 'article') {
        if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            article();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
                addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
}
else {
    allArticles();
}
