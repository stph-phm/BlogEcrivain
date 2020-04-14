<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog ecricain </title>
</head>

<body>
    <div class="global">
        <h1>Billet simple pour l'Alaska </h1>
        <p><a href="index.php">Retour</a></p>

        <article>
            <div class="header-article">
                <h2><?= htmlspecialchars($post['title']) ?> </h2>
            </div>

            <div class="content-article">
                <p> <?= $post['content'] ?> <?= $post['date_fr'] ?> </p>
            </div>
        </article>

        <div class="comments">
            <h3>Commentaires : </h3>
            <?php while($comment = $comments->fetch()): ?>
            <section>
                <p><?= $comment['pseudo'] ?> a <?= $comment['date_fr'] ?></p>

                <p><?= $comment['comment'] ?> </p>

            </section>
            <?php endwhile; ?>
        </div>
        <!---->
    </div>
    <!--global-->
</body>

</html>