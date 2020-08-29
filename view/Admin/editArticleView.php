<?php $title = "Modifier le chapitre :" ;  ?>
<?php ob_start(); ?>

<div class="global editArtcleGlobale ">
    <a href="index.php?action=manageArticle"> Retour à la gestion des articles</a>
    <h1 class="text-center">Modifier un article </h1>
    <form action="index.php?action=edit&amp;id= <?= $article['id'] ?>" method="post">
        <div class="form-group">
            <label for="title">Titre du chapitre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $article['title'] ?>">
        </div>
        <div class="form-group">
            <label for="content">Contenue du chapitre </label>
            <textarea name="content" id="default" class="form-control" rows="20">
                <?= $article['content'] ?>  
            </textarea>
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Modifier</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>