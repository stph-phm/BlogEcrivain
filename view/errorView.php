<?php $title = "Erreur 404" ?>

<?php ob_start(); ?>
    <div class="alert alert-danger" role="alert">
        <p class="text-center">Erreur 404 : <?= $errorMsgBlock  ?></p>
    </div>
<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>