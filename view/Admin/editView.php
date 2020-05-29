<?php $title = "Modifier le chapitre :" ;  ?>
<?php ob_start(); ?>
<div class="global dashboard ">

    <h1>Modigier un article </h1>
    <div class="form-newArticle">
        <div class="form-group form_header">
            <form action="index.php?action=edit&amp;id=" method="post">
                <div class="form-group">
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
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>