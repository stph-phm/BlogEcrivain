<?php $title = "Inscription" ?>

<?php ob_start(); ?>
<div class="global connect text-center">
    <h1>Espace membre - inscription </h1>

    <div class="form-div text-center">
        <form action="" method="post">
            <div>
                <label for="username">Votre identifiant : </label>
                <input type="text" class="form-control" name="username" id="username">

                <label for="email">Votre e-mail : </label>
                <input type="email" class="form-control" name="email" id="email">

                <label for="pswd">Votre mot de passe : </label>
                <input type="password" class="form-control" name="pswd" id="pswd">


                <label for="pswd2">Confirmez votre mot de passe : </label>
                <input type="password" class="form-control" name="pswd2" id="pswd2"> <br>
            </div>

            <button type="submit" class="btn btn-primary" name="register"> S'inscrire</button>
        </form>
    </div>

    <?php
    if (isset($error)) {
        var_dump($error);
    }
    exit();
    if (isset($errorMsg)) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMsg ?>
        </div>
    <?php }
    ?>

    <a href="index.php?action=login"> Un compte ? Connectez-vous </a>
</div><!--/.global-->
<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>