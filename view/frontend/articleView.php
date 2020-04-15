<?php $title = htmlspecialchars($article['title']); ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p><a href="index.php">Retour à la liste des chapitres:</a></p>

<div class="global">
    <div class="news">
        <article>
            <h2>
                <?= htmlspecialchars($article['title']) ?>
                <em>le <?= $article['date_fr'] ?></em>
            </h2>

            <p>
                <?= nl2br($article['content']) ?>
            </p>
        </article>
    </div>
    <section>
        <h2>Commentaires</h2>

        <?php while ($allcomments = $comments->fetch()) :?>
        <div class="section-comments">
            <p>
                <strong>
                    <?= htmlspecialchars($allcomments['pseudo']) ?>
                </strong> 
                le <?= $allcomments['date_fr'] ?>
            </p>
            <p><?= nl2br(htmlspecialchars($allcomments['comment'])) ?></p>
        </div>
    </section>
</div><!--global-->

<?php endwhile; ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>