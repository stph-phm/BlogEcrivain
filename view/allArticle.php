<?php $title = "Tous les chapitres"; ?>

<?php ob_start(); ?>
<div class="list-article">
<h1 class="text-center mb-3">Tous les chapitres </h1>
<?php foreach ($listArticle as  $allArticle) { ?>
     <section class="card">
          <h1 class="text-center"> <a href="index.php?action=article&amp;id=<?= $allArticle['id'] ?>" class="text-dark"><?= htmlspecialchars($allArticle['title']) ?></a></h1>

          <p class="text-center"><?= date_format(date_create($allArticle['date_article']), 'd/m/Y à H:i') ?></p>
          <p><?= substr($allArticle['content'],0,390) ?>... <a href="index.php?action=article&amp;id=<?= $allArticle['id'] ?>" >Lire la suite</a></p> 
     </section>
          
<?php } ?>

</div><!--/.list-article-->

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>