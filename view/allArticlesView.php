<?php $title = "Homepage" ?>

<?php ob_start(); ?>
    <div class="container global">
        <div class="header">
            <header>
                <div class="image-header">
                    <img src="public/image/image1.jpg" alt="route alaska">
                </div>
                <h1>Billet simple pour l'Alaska</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur, molestias amet assumenda
                    doloremque voluptate consequatur vitae incidunt, ea ducimus atque iusto, harum eligendi repellat
                    laboriosam labore ipsam beatae aspernatur dolor. RESUMER DE L'HISTOIRE</p>
            </header>
        </div><!--header-->

        <div class="list-article">
            <?php foreach ($listArticle as  $allArticle) { ?>
            <section>
                <div class="header-section">

                    <a href="index.php?action=article&amp;id=<?= $allArticle['id'] ?>"> <h3> <?= htmlspecialchars($allArticle['title']) ?> </h3></a>
                    <p> <?= date_format(date_create($allArticle['date_article']), 'd/m/Y à H:i') ?> </p>
                </div>

                <div class="content-section">
                    <p> <?= nl2br(substr($allArticle['content'],0,390)) ?>... <a href="index.php?action=article&amp;id=<?= $allArticle['id'] ?>">Lire la suite</a> </p>
                </div>
            </section>
            <?php 
            }
            ?>
        </div><!--/.list-article-->
    </div><!--/.global-->

    <?php $content = ob_get_clean(); ?>
    <?php include 'template.php'; ?>



