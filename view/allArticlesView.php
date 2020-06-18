<?php $title = "Homepage" ?>

<?php ob_start(); ?>
<div class="global">
    <div class="header mb-4 row">
        <header>
            <div class="image-header mb-3 text-center container">
                <img src="public/image/image1.jpg" alt="route alaska">
            </div>
            <div class="border text-center col mx-auto ">
                <h1 class="text-center">Billet simple pour l'Alaska</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur, molestias amet assumenda
                    doloremque voluptate consequatur vitae incidunt, ea ducimus atque iusto, harum eligendi repellat
                    laboriosam labore ipsam beatae aspernatur dolor. RESUMER DE L'HISTOIRE</p>
            </div>

        </header>
    </div>
    <!--header-->

    <div class="row">
        <div class="new-article col-10 mx-auto">
            <?php foreach ($newArticle as  $lastArticle) { ?>
            <div class="jumbotron">
                <div class="title d-flex flex-row ">
                    <h2 class="display-4 "><a href="index.php?action=article&amp;id=<?= $lastArticle['id'] ?>"
                            class="text-dark">
                            <?= $lastArticle['title'] ?> </a> </h2> &ensp;
                    <h3><span class="badge badge-secondary">New</span></h3>
                </div>
                <p class="lead"><?= substr($lastArticle['content'],0,390) ?>... </p>

                <a class="btn btn-primary btn-lg" href="index.php?action=article&amp;id=<?= $lastArticle['id'] ?>" role="button">Lire la suite</a>
            </div>
            <?php } ?>
        </div>
    </div>
    <hr>


    <div class="list-article container">
        <?php foreach ($listArticle as  $allArticle) { ?>
        <section>
            <div class="card mb-2">
                <div class="card-body">
                    <h2 class="card-title text-center"><a class="text-dark"
                            href="index.php?action=article&amp;id=<?= $allArticle['id'] ?>"><?= htmlspecialchars($allArticle['title']) ?></a>
                    </h2>

                    <p class="card-subtitle mb-2 text-muted text-center">
                        <?= date_format(date_create($allArticle['date_article']), 'd/m/Y à H:i') ?></p>

                    <p class="card-text"><?= substr($allArticle['content'],0,390) ?>... </p>
                    <a href="index.php?action=article&amp;id=<?= $allArticle['id'] ?>"
                        class="card-link btn btn-primary">Lire la
                        suite</a>
                </div>
            </div>
        </section>
        <?php 
            }
            ?>
    </div>
    <!--/.list-article-->
</div>
<!--/.global-->

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>