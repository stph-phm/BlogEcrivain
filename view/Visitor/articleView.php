<?php $title = htmlspecialchars($article['title']); ?>

<?php ob_start(); ?>
<div class="col-11 mx-auto">

    <div class="jumbotron jumbotron-fluid rounded ">
        <div class="ml-5">
            <h1 class="display-4 mb-3">Billet simple pour l'Alaska</h1>
            <p class="lead mb-3"><a href="index.php?action=listArticles">Retour à la liste des chapitres:</a></p>
        </div>

        <div class="container">
            <div class="news">
                <article>
                    <h1 class="text-center  mb-3"> <?= htmlspecialchars($article['title']) ?> </h1>
                </article>
            </div>
            <p class="lead"> <?= nl2br($article['content']) ?> </p>
            <p class="lead text-right"> publié le : <?=  date_format(date_create($article['date_article']), 'd/m/Y à H:i') ?></p> 
        </div>
    </div>
</div>

<?php 
    if ($isConnected) { ?>
<section class="container">
    <h2>Commentaire</h2>

    <form action="index.php?action=addComment&amp;id= <?= $article['id']?>" method="POST">
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea id="mytextarea" class="form-control" rows="3" name="comment"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Commentez">
    </form>
    <?php } else { ?>

        <div class="jumbotron jumbotron-fluid container rounded">
            <p class="lead text-center"> <a href="index.php?action=login" class="text-center">Connectez-vous pour pouvoir commenter</a>
            </p>
        </div>

    <?php  } ?>

    <?php if (isset($_SESSION['successMsg'])) { ?>
        <div class="alert alert-success"> <?= $_SESSION['successMsg'] ?> </div>
    <?php
        unset($_SESSION['successMsg']);
    } ?>

    <?php if (isset($_SESSION['errorMsg'])) { ?>
        <div class="alert alert-danger"> <?= $_SESSION['errorMsg'] ?> </div>
        <?php
        unset($_SESSION['errorMsg']);
    } ?>


    <?php foreach ($listComment as $comment) { ?>
    <div class="comments container">
        <div class="pseudo-partComment d-flex p-2 ">
            <p>
                <strong> <?= $comment['pseudo'] ?> </strong>
                <?= date_format(date_create($comment['date_comment']), 'd/m/Y à H:i') ?> : &nbsp;
            </p>

            <p>
                <?php if ($comment['reported'] == 0) { ?>

                <a class="btn btn-secondary btn-sm " href="index.php?action=reportComment&amp;id= <?= $comment['id'] ?>"
                    title="Signaler le commentaire"><span><i class="fas fa-flag"></i></span>&nbsp;</a>

                <?php if ($isAdmin) { ?>
                    <a class="btn btn-secondary btn-sm " href="index.php?action=deleteComment&amp;id= <?= $comment['id'] ?>"> Supprimer le commentaire</a>

                <?php } ?>
            </p>
            <?php } else { ?>
            <p class="text-danger"><span><i class="fas fa-flag"></i></span>&nbsp;</p>

            <?php } ?>
            <!--else-->
        </div>

        <p> <?=  $comment['comment'] ?> </p>
        <hr>
    </div>
    <?php } ?>

    <!--foreach-->
</section>


<?php $content = ob_get_clean(); ?>

<?php include 'view/template.php'; ?>