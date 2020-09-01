<?php $title = "Tous les chapitres"; ?>

<?php ob_start(); ?>
<div id="article" class="jumbotron jumbotron-fluid">
    <h1 class="cardTitle text-center mb-3">Tous les chapitres </h1>
    <?php foreach ($articles as  $articles) { ?>
        <section class="container card mb-4">
            <h2 class="text-center mb-3"> <a href="index.php?action=article&amp;id=<?= $articles['id'] ?>" class="text-dark">
                    <?= htmlspecialchars($articles['title']) ?></a>
            </h2>

            <p class="text-center"><?= date_format(date_create($articles['date_article']), 'd/m/Y à H:i') ?></p>
            <p class="text-center"><?= mb_substr($articles['content'],0,400) ?>...
                <a href="index.php?action=article&amp;id=<?= $articles['id'] ?>" >Lire la suite</a>
            </p>
        </section>

    <?php } ?>
</div><!--/.list-article-->
<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>