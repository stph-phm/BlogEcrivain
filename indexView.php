<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog ecrivain</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="global">
        <div class="header">
            <header>
                <div class="image-header">
                    <img src="image1.jpg" alt="route alaska">
                </div>
                <h1>Billet simple pour l'Alaska</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur, molestias amet assumenda
                    doloremque voluptate consequatur vitae incidunt, ea ducimus atque iusto, harum eligendi repellat
                    laboriosam labore ipsam beatae aspernatur dolor. RESUMER DE L'HISTOIRE</p>
            </header>
        </div>
        <!--header-->

        <div class="list-article">
            <?php while ($allArticles = $req->fetch()): ?>
            <section>
                <div class="header-section">

                    <a href="post.php?id=<?= $allArticles['id'] ?>"> <h3> <?= htmlspecialchars($allArticles['title']) ?> </h3></a>
                    <p> <?= $allArticles['date_fr'] ?> </p>
                </div>

                <div class="content-section">
                    <p> <?= nl2br(substr($allArticles['content'],0,390)) ?>... <a href="post.php?id=<?= $allArticles['id'] ?>">Lire la suite</a> </p>
                </div>
            </section>
            <?php 
                endwhile;
                $req->closeCursor();
            ?>
        </div>
        <!--list-article-->
    </div>
    <!--global-->
</body>

</html>