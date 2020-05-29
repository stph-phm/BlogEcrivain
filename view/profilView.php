<?php $title = "Profile" ?>

<?php ob_start(); ?>


    <div class="global">
        <h1>Bonjour <?= $userInfo['username']  ?> </h1>

        <p>adresse mail : <?= $userInfo['email_user'] ?></p>
        <p>date de creation : <?= $userInfo['creation_user'] ?> </p>
    </div>


<?php $content = ob_get_clean(); ?>
<?php include 'template.php'; ?>