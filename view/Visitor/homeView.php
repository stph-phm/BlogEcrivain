<?php $title = "Homepage" ?>

<?php ob_start(); ?>

<div class="globalContent container-fluid">
    <header class="header text-center">
        <div class="imageHeader">
            <img src="public/image/image1.jpg" alt="route alaska">
        </div>
        <div class="ContentHeader">
            <h1 class="titleHeader">Billet simple pour l'Alaska</h1>
            <p class="contentHeader">
                Un résumé permet d’évaluer la capacité d’un étudiant à analyser et synthétiser un support.
                Il s’agit d’écarter tout ce qui est accessoire du contenu essentiel d’un texte. Généralement,
                le candidat doit rédiger un résumé compris entre 250 et 300 mots, avec une marge d’erreur tolérée
                d’environ 10%.
                Un bon résumé est donc concis et efficace : il reprend de manière concise et efficace, l’essentiel du
                contenu d’un document
                (littéraire ou non), en respectant les contraintes données.
            </p>
        </div>
    </header>


    <section class="text-center">
        <div class="titleSection">
            <h1 class="titleSection">Les 5 derniers chapitres : </h1>
        </div>

        <article>
            <?php foreach ($lastArticles as  $lastArticle) { ?>
            <div class="article-global">
                <div class="article-global">
                    <div class="article-title">
                        <h2>
                            <a href="index.php?action=article&amp;id=<?= $lastArticle['id'] ?>"
                                class="text-dark"><?= $lastArticle['title'] ?> </a>
                        </h2> &ensp;
                    </div>

                    <div class="article-content">
                        <p class="articlePara ">
                            <?= date_format(date_create($lastArticle['date_article']), 'd/m/Y à H:i') ?>
                            <?= nl2br(mb_substr($lastArticle['content'], 0, 400))  ?> ...
                            <a href="index.php?action=article&amp;id=<?= $lastArticle['id'] ?>" class="link-read-more">Lire la suite</a>
                        </p>
                    </div>
                </div>
            </div>
            <hr>

            <?php } ?>
        </article>

        <p>
        <a href="index.php?action=listArticles" class="linkListArticle btn btn-primary">La liste des tous les chapitres </a>
        </p>
    </section>

</div>
<!--/.global-->

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>