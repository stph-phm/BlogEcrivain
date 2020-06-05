<?php $title = "Profile" ?>

<?php ob_start(); ?>


    <div class="global">
        <h1>Bonjour <?= $_SESSION['id']?> <?= $userInfo['id'] ?></h1>
        <p>adresse mail :</p>
        <p>date de creation :  </p>
    </div>


<?php $content = ob_get_clean(); ?>
<?php include 'template.php'; ?>