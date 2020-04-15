<?php $title = "Homepage" ?>

<?php ob_start(); ?>
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

                    <a href="article.php?id=<?= $allArticles['id'] ?>"> <h3> <?= htmlspecialchars($allArticles['title']) ?> </h3></a>
                    <p> <?= $allArticles['date_fr'] ?> </p>
                </div>

                <div class="content-section">
                    <p> <?= nl2br(substr($allArticles['content'],0,390)) ?>... <a href="article.php?id=<?= $allArticles['id'] ?>">Lire la suite</a> </p>
                </div>
            </section>
            <?php 
                endwhile;
                $req->closeCursor();
            ?>
        </div><!--/.list-article-->

        <footer>
            <p> Site réalisé par Stéphanie Pham dans le cadre de la formation Openclassrooms</p>
        </footer>
    </div><!--/.global-->

    <?php $content = ob_get_clean(); ?>
    <?php include 'template.php'; ?>



