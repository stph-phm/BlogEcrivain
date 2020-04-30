<?php $title = "Connect" ?>

<?php ob_start(); ?>
    <div class="global">
        <h1>Se connecter </h1>

        <form action="index.php?action=admin" method="post">
            <div>
                <label for="username">Votre identifiant : </label>
                <input type="text" name="username" id="username"> <br>
                <label for="password">Votre mot de passe : </label>
                <input type="password" name="password" id="password">
            </div>
                <input type="button" name="submit" value="Se connecter">
        </form>
    </div><!--/.global-->

    <?php $content = ob_get_clean(); ?>
    <?php include 'template.php'; ?>



