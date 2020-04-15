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
}
else {
    allArticles();
}
