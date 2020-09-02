<?php $title = "Création d'un chapitre";  ?>
<?php ob_start(); ?>

<div class="global dashboard ">
    <h1 class=" addArticleHeader text-center">Création d'un chapitre </h1>

    <div class="form-newArticle">
        <form class="newArticle" action="" method="post">
            <div class="form-group form_header">

                <label id="title" for="title">Titre du chapitre</label>
                <input type="text" class="form-control title" name="title" value=" <?=   $article_title ?> ">

            </div>
            <div class="form-group form_content">
                <label for="content">Contenu de l'article </label>
                <textarea id="default" class="form-control" name="content" rows="18" name="content">
                    <?= $content ?> 
                </textarea>
            </div>
            
            <button type="submit" class="btn btn-primary text-align-center" name="submit">Publier</button>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>