<?php $title = htmlspecialchars($article['title']); ?>

<?php ob_start(); ?>


<div class="container global">
    <h1>Billet simple pour l'Alaska</h1>
    <p><a href="index.php">Retour à la liste des chapitres:</a></p>

    <div class="container news">
        <article>
            <h2 class="text-center">
                <?= htmlspecialchars($article['title']) ?>
            </h2>

            <p> <?= $article['content'] ?> </p>
            <p class="text-right"> publié le : <?= $article['date_fr'] ?></p>
        </article>
    </div>
    <!--news-->

    <?php 
    if (!$isConnected) { ?>
    <section>
        <h2>Commentaire</h2>

        <form action="index.php?action=addComment&amp;id= <?= $article['id']?>" method="POST">
            <div class="form-group">
                <label for="pseudo"> Pseudo </label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="">
            </div>
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
                        if ($comment['reported'] == 1) { ?>

                    <a class="btn btn-secondary btn-sm"
                        href="index.php?action=reportComment&amp;id= <?= $comment['id'] ?>"><span><i
                                class="fas fa-flag"></i></span>&nbsp; Signaler</a>
                </p>
                <?php } else { ?>
                <p class="text-danger"><span><i class="fas fa-flag"></i></span>&nbsp;Signalé</p>
                <?php } ?>
                <!--else-->
            </div>

            <p> <?=  $comment['comment'] ?> </p>
            <hr>
        </div>
        <?php } ?>
        <!--foreach-->
    </section>
</div>
<!--global-->

<?php $content = ob_get_clean(); ?>

<?php include 'template.php'; ?>