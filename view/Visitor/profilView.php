<?php $title = "Profil" ?>

<?php ob_start(); ?>

<div class="part-info-user text-center ">
    <h1>Bonjour <?= $this->userInfo['username'] ?></h1>

    <p>Adresse mail : <?= $this->userInfo['email_user'] ?></p>
    <p>Date de creation : <?= date_format(date_create($this->userInfo['date_user']), 'd/m/Y à H:i') ?> </p>
</div>

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>