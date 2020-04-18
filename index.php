<?php 
include 'controller/frontend.php';
$action = '';
if (isset($_GET['action'])) {
    $action = trim($_GET['action']);
}


switch ($action) {
    case 'allArticle':
        allArticles();
        break;
    case 'article';
        article();
        break;
    case 'addComment':
        addComment($article_id, $pseudo, $comment);
        break;   
    default:
        allArticles();
        break;
}

// try {
//     if (isset($_GET['action'])) {
//         if ($_GET['action'] == 'allArticles') {
//             allArticles(); //OK ! 
//         } 
//         elseif ($_GET['action'] == 'article') {
//             if (isset($_GET['id']) && $_GET['id'] > 0 ) {
//                 article();
//             }
//             else {
//                 throw new Exception('Aucun identifiant de billet envoyé');
//             }
//         } // OK ! 
        // elseif ($_GET['action'] == 'addComment') {
        //     if (isset($_GET['id']) && $_GET['id'] > 0) {
        //         if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
        //             addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);
        //         }                 else {
        //             throw new Exception('Tous les champs ne sont pas remplis !');
        //         }             
        //     }
//             else {
//                 throw new Exception('Aucun identifiant de billet envoyé');
//             }
//         }
// }
//     }
//     else {
//         allArticles();
//     }   
// }
// catch (Exception $e) {
 //   echo 'Erreur :' .$e->getMessage();

