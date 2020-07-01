<?php $title = "Homepage" ?>

<?php ob_start(); ?>
<div class="global mt-3">
    <div class="header mb-4 row">
        <header>
            <div class="image-header mb-3 text-center container">
                <img src="public/image/image1.jpg" alt="route alaska" class="mb-4">
            </div>
            <div class="border text-center col mx-auto ">
                <h1 class="text-center mt-3">Billet simple pour l'Alaska</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur, molestias amet assumenda
                    doloremque voluptate consequatur vitae incidunt, ea ducimus atque iusto, harum eligendi repellat
                    laboriosam labore ipsam beatae aspernatur dolor. RESUMER DE L'HISTOIRE</p>
            </div>

        </header>
    </div>
    <!--header-->

    <div class="title">
        <h1 class="text-center mb-4">Les 5 derniers chapitres : </h1>
    </div>
    
    <div class="new-article col-10 mx-auto">
        <?php foreach ($newArticle as  $lastArticle) { ?>
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



    <p class="text-center"><a href="index.php?action=allArticle" class="btn btn-primary"> La liste des tous les
            chapitres </a></p>

</div>
<!--/.global-->

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>