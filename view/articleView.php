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

            <p> <?= nl2br($article['content']) ?> </p>
            <p class="text-right"> publié le : <?= $article['date_fr'] ?></p>
        </article>
    </div><!--news-->

    <section>
        <h2>Commentaire</h2>

        <form action="index.php?action=addComment&amp;id= <?= $article['id'] ?>" method="POST">
            <div class="form-group">
                <label for="pseudo">pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo">
            </div>
            <div class="form-group">
                <label for="comment">Commentaire</label>
                <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
            </div>

            <button class ="btn btn-primary" type="submit" name="submit">Commenter</button>
        </form>

        <?php foreach ($listComments as $comments) { ?>
        <div class="comments">
            <div class="pseudo-partComment d-flex p-2 ">
                <p>
                    <strong> <?= $comments['pseudo'] ?> </strong>
                    <?= date_format(date_create($comments['date_comment']), 'd/m/Y à H:i') ?> : &nbsp;
                </p>

                <p>
                    <?php 
                        if ($comments['reported'] == 0) { ?>
                            <form action="index.php?action=reportComment&amp;id= <?= $article['id'] ?>" method="post">
                                <button type="submit"><span><i class="fas fa-flag"></i></span>&nbsp; Signaler</button>
                            </form>
                            <!--<a class="btn btn-secondary btn-sm" href="index.php?action=reportComment&amp;id= <?= $comments['id'] ?>"><span><i class="fas fa-flag"></i></span>&nbsp; Signaler</a>-->
                </p>
                    <?php } else { ?>
                            <p class="text-danger"><span><i class="fas fa-flag"></i></span>&nbsp;Signalé</p> 
                    <?php } ?><!--else-->
            </div>

            <p> <?=  $comments['comment'] ?> </p>
            <hr>
        </div>
        <?php } ?><!--foreach-->
    </section>
</div><!--global-->

<?php $content = ob_get_clean(); ?>

<?php include 'template.php'; ?>