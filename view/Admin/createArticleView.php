<?php $title = "Création d'un article";  ?>
<?php ob_start(); ?>
<div class="global dashboard ">

    <h1>Création d'un article </h1>
    <div class="form-newArticle">
        <form class="newArticle" action="" method="post">
            <div class="form-group form_header">
                <label class="nbChap" for="nbChap">Chapitre N° : </label>
                <input type="text" class="form-control nbChap"  id="nbChap" name="nbChap">

                <label id="title" for="title">Titre du chapitre</label>
                <input type="text" class="form-control title" name="title">
                
            </div>
            <div class="form-group">
                <label for="content">Contenue de l'article </label>
                <textarea class="form-control" name="content" id="content"  rows="18" name="content"></textarea>
            </div>

            <button type="submit" class="btn btn-primary text-align-center" name="submit">Publier</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>