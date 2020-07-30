<?php $title = "Création d'un article";  ?>
<?php ob_start(); ?>
<div class="global dashboard ">
    <h1 class="mb-4 text-center">Création d'un article </h1>

    <?php if (isset($_SESSION['errorMsg'])) { ?>
        <div class="alert alert-danger"> <?= $_SESSION['errorMsg'] ?> </div>
        <?php
        unset($_SESSION['errorMsg']);
    } ?>

    <div class="form-newArticle">
        <form class="newArticle" action="" method="post">
            <div class="form-group form_header">

                <label id="title" for="title">Titre du chapitre</label>
                <input type="text" class="form-control title" name="title">

            </div>
            <div class="form-group">
                <label for="content">Contenue de l'article </label>
                <textarea id="default" class="form-control" name="content" id="content" rows="18"
                    name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary text-align-center" name="submit">Publier</button>
        </form>
    </div>
</div>



<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>