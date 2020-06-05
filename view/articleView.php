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

    <?php 
    if ($_SESSION == 0 ) { ?>
            <section>
        <h2>Commentaire</h2>

        <form action="index.php?action=addComment&amp;id= <?= $article['id'] ?>&amp;id=<?= $userInfo['id'] ?>" method="POST">
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
                            
                        <a class="btn btn-secondary btn-sm" href="index.php?action=reportComment&amp;id= <?= $comment['id'] ?>"><span><i class="fas fa-flag"></i></span>&nbsp; Signaler</a>
                </p>
                    <?php } else { ?>
                            <p class="text-danger"><span><i class="fas fa-flag"></i></span>&nbsp;Signalé</p> 
                    <?php } ?><!--else-->
            </div>

            <p> <?=  $comment['comment'] ?> </p>
            <hr>
        </div>
        <?php } ?><!--foreach-->
    </section>
    <?php 
    } 
    else { ?>
        <p>Connectez-vous, pour pouvoir commenter</p> <a href="index.php?action=login"> se connecter</a>
    <?php 
    } ?>

</div><!--global-->

<?php $content = ob_get_clean(); ?>

<?php include 'template.php'; ?>