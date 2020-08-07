<?php $title = "Homepage" ?>

<?php ob_start(); ?>
<?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success text-center"> <?= $_SESSION['success'] ?> </div>
    <?php unset($_SESSION['success']); ?>
<?php } ?>
<div class="global mt-3 jumbotron jumbotron-fluid align-center">
    <div class="header ">
        <header class="text-center">
            <div class="image-header mb-3 text-center container">
                <img src="public/image/image1.jpg" alt="route alaska" class="mb-4" class="text-center">
            </div>

            <div class="border text-center col mx-auto ">
                <h1 class="text-center mt-3">Billet simple pour l'Alaska</h1>
                <p>Un résumé permet d’évaluer la capacité d’un étudiant à analyser et synthétiser un support.
                    Il s’agit d’écarter tout ce qui est accessoire du contenu essentiel d’un texte. Généralement,
                    le candidat doit rédiger un résumé compris entre 250 et 300 mots, avec une marge d’erreur tolérée d’environ 10%.
                    Un bon résumé est donc concis et efficace : il reprend de manière concise et efficace, l’essentiel du contenu d’un document
                    (littéraire ou non), en respectant les contraintes données.</p>
            </div>

        </header>
    </div>
    <!--header-->

    <div class="title">
        <h1 class="text-center mb-4">Les 5 derniers chapitres : </h1>
    </div>
    
    <div class="new-article col-10 mx-auto">
        <?php foreach ($lastArticles as  $lastArticle) { ?>
        <div class="new text-center mb-4">
            <div class="new_title">
                <h2>
                    <a href="index.php?action=article&amp;id=<?= $lastArticle['id'] ?>"
                        class="text-dark"><?= $lastArticle['title'] ?> </a>
                </h2> &ensp;
            </div>

            <p><?= date_format(date_create($lastArticle['date_article']), 'd/m/Y à H:i') ?></p>
            <p class="lead"><?= substr($lastArticle['content'],0,390) ?>... <a
                    href="index.php?action=article&amp;id=<?= $lastArticle['id'] ?>" role="button"
                    class="link-read-more">Lire la suite</a></p>
        </div>
        <hr>

        <?php } ?>
    </div>



    <p class="text-center"><a href="index.php?action=listArticles" class="btn btn-primary"> La liste des tous les
            chapitres </a></p>

</div>
<!--/.global-->

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>