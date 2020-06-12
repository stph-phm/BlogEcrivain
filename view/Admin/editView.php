<?php $title = "Modifier le chapitre :" ;  ?>
<?php ob_start(); ?>

<?php 
if (!$isAdmin) { ?>
<div class="global dashboard ">
    <h1>Modifier un article </h1>

    <a href="index.php?action=manageArticle"> Retour à la gestion des articles</a>


    <form action="index.php?action=edit&amp;id= <?= $article['id'] ?>" method="post">

        <div class="form-group">
            <label for="title">Titre du chapitre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $article['title'] ?>">
        </div>
        
        <div class="form-group">
            <label for="content">Contenue du chapitre </label>
            <textarea id="default" class="form-control" name="content" id="content" rows="18"
                name="content"><?= $article['content'] ?></textarea>
        </div>
        <input type="submit" value="Modifier">
        

    </form>
</div>
<?php } else { ?>
<div class="alert alert-danger" role="alert">
    <h1 class="text-center">Accès refuser</h1>
</div>
<?php
}
?>



<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>