<?php $title = "Connect" ?>

<?php ob_start(); ?>
<div class="global connect text-center">
    <h1>Espace membre - connexion </h1>

    <div class="form-div text-center">
        <form action="" method="post">
            <div>
                <label for="email">Votre adresse e-mail : </label>
                <input type="email" class="form-control" name="email" id="email"> <br>
                <label for="pswd">Votre mot de passe : </label>
                <input type="password" class="form-control" name="pswd" id="pswd"> <br>
            </div>
            <button type="submit" class="btn btn-primary" name="connect">Se connecter</button>
        </form>
    </div>
    <?php
    if (isset($errorMsg)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMsg ?>
    </div>
    <?php } ?>
    
    <a href="index.php?action=register"> Pas de compte ? Inscrivez vous</a>
</div>
<!--/.global-->

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>