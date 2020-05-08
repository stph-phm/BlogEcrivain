<?php $title = "Connect" ?>

<?php ob_start(); ?>
    <div class="global connect">
        <h1>Se connecter </h1>

        <form action="#" method="post">
            <div>
                <label for="username">Votre identifiant : </label>
                <input type="text" name="username" id="username"> <br>
                <label for="password">Votre mot de passe : </label>
                <input type="password" name="password" id="password">
            </div>
                <input type="button" name="submit" value="Se connecter">
        </form>

        <a href="index.php?action=register"> Pas de compte ? Inscrivez vous</a>
    </div><!--/.global-->

    <?php $content = ob_get_clean(); ?>
    <?php include 'template.php'; ?>



