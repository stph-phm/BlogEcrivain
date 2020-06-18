<?php $title = htmlspecialchars($article['title']); ?>

<?php ob_start(); ?>
<div class="col-11 mx-auto">

    <div class="jumbotron jumbotron-fluid rounded ">
        <div class="ml-5">
            <h1 class="display-4">Billet simple pour l'Alaska</h1>
            <p class="lead"><a href="index.php">Retour à la liste des chapitres:</a></p>
        </div>

        <div class="container">
            <div class="news">
                <article>
                    <h1 class="text-center  mb-3"> <?= htmlspecialchars($article['title']) ?> </h1>
                </article>
            </div>
            <p class="lead"> <?= nl2br($article['content']) ?> </p>
            <p class="lead text-right"> publié le : <?= $article['date_fr'] ?></p>
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
            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
        </div>
        <input type="submit" value="Commentez">
    </form>
    <?php } else { ?>
    <p></p>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <p class="lead"><a href="index.php?action=login">Connectez-vous pour pouvoir commenter</a>
            </p>
        </div>
    </div>
    <?php  } ?>
    <?php foreach ($listComment as $comment) { ?>
    <div class="comments">
        <div class="pseudo-partComment d-flex p-2 ">
            <p>
                <strong> <?= $comment['pseudo'] ?> </strong>
                <?= date_format(date_create($comment['date_comment']), 'd/m/Y à H:i') ?> : &nbsp;
            </p>

            <p>
                <?php 
                        if ($comment['reported'] == 0) { ?>

                <a class="btn btn-secondary btn-sm"
                    href="index.php?action=reportComment&amp;id= <?= $comment['id'] ?>" title="Signaler le commentaire"><span><i
                            class="fas fa-flag"></i></span>&nbsp;</a>
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

<?php include 'template.php'; ?>