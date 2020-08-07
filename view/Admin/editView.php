<?php $title = "Modifier le chapitre :" ;  ?>
<?php ob_start(); ?>

<?php if(isset($_SESSION['success'])) { ?>
    <div class="alert alert-success text-center"> <?= $_SESSION['success'] ?> </div>
<?php unset($_SESSION['success']) ?>

<?php } elseif(isset($_SESSION['error'])) { ?>

    <div class="alert alert-danger text-center"> <?= $_SESSION['error'] ?> </div>
    <?php unset($_SESSION['error']) ?>
<?php } elseif(isset($_SESSION['info'])) { ?>

    <div class="alert alert-info" role="alert"> <?= $_SESSION['info'] ?></div>
<?php } ?>

<div class="global dashboard ">
<a href="index.php?action=manageArticle"> Retour à la gestion des articles</a>

    <h1 class="text-center">Modifier un article </h1> 
    
    <form action="index.php?action=edit&amp;id= <?= $article['id'] ?>" method="post">

        <div class="form-group">
            <label for="title">Titre du chapitre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $article['title'] ?>">
        </div>
        
        <div class="form-group">
            <label for="content">Contenue du chapitre </label>
            <textarea name="content" id="default" class="form-control" rows="20"> <?= $article['content'] ?>  </textarea>
        </div>

        <button class="btn btn-primary" type="submit" name="submit">Modifier</button>
        
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>