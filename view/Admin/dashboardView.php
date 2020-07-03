<?php $title = "Tableau de bord";  ?>
<?php ob_start(); ?>

<h1> Hey </h1>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>