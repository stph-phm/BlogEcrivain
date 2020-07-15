<?php $title = "Profile" ?>

<?php ob_start(); ?>

<div class="part-info-user container text-center">
    <h1>Bonjour <?= $userInfo['username'] ?></h1>

    <p>adresse mail : <?= $userInfo['email_user'] ?></p>
    <p>date de creation : <?= date_format(date_create($userInfo['date_user']), 'd/m/Y à H:i') ?> </p>
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>