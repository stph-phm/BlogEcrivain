<?php

include 'model.php';

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $post = getArticle($_GET['id']);
    $comments = getAllComments($_GET['id']);

    include 'postView.php';
}
else {
    echo 'Erreur : aucun identifiant de billet envoyé';
}