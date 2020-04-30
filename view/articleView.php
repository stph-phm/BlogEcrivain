<?php $title = htmlspecialchars($article['title']); ?>

<?php ob_start(); ?>


<div class="container global">
    <h1>Billet simple pour l'Alaska</h1>
    <p><a href="index.php">Retour à la liste des chapitres:</a></p>

    <div class="container news">
        <article>
            <h2>
                <?= htmlspecialchars($article['title']) ?>
            </h2>

            <p> <?= nl2br($article['content']) ?> </p>
            <p> publié le : <?= $article['date_fr'] ?></p>
        </article>
    </div>
    <!--news-->

    <section>
        <h2>Commentaires</h2>

        <div class="form-comment">
            <form action="index.php?action=addComment&amp;id=<?= $article['id'] ?>" method="post">
                <div>
                    <label for="pseudo">Pseudo : </label> <br>
                    <input type="text" name="pseudo" id="pseudo">
                </div>
                <div>
                    <label for="comment">Commentaire : </label> <br>
                    <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <input type="submit" value="Commenter">
                </div>
            </form>
        </div>
        <!--form-comment-->

        <?php foreach ($comments as $allComments) { ?>
        <div class="container section-comments">
            <p>
                <strong>
                    <?= htmlspecialchars($allComments['pseudo']) ?>
                </strong>
                le <?= $allComments['date_fr'] ?> :
            </p>
            <p>
                <?= nl2br(htmlspecialchars($allComments['comment'])) ?>
            </p>
                <form action="index.php?action=reportComment&amp;id=<?= $article['id'] ?>" method="post">
                    <button type="submit" name="report">Signaler</button>
                </form>
        </div>
    </section>
</div>
<!--global-->

<?php }?>
<?php $content = ob_get_clean(); ?>

<?php include 'template.php'; ?>