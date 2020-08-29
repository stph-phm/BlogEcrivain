<?php $title = "Connexion" ?>
<?php ob_start(); ?>

<div class="global connect text-center">
    <h1 class="connectTitle">Espace membre - connexion </h1>

    <div class="form-div text-center">
        <form action="" method="post">
            <div>
                <label for="email">Votre adresse e-mail : </label>
                <input type="email" class="form-control" name="email" id="email" value="<?= $email ?>"> <br>
                <label for="pswd">Votre mot de passe : </label>
                <input type="password" class="form-control" name="pswd" id="pswd" value="<?= $pswd ?>"> <br>
            </div>
            <button type="submit" class="btn btn-primary" name="connect">Se connecter</button>
        </form>
    </div>

    <a href="index.php?action=register"> Pas de compte ? Inscrivez vous</a>

</div><!--/.global-->

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>