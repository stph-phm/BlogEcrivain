<?php $title = "Inscription" ?>

<?php ob_start(); ?>
    <div class="global connect">
        <h1>Espace membre - inscription </h1>

        <form action="" method="post">
            <div>
                <label for="username">Votre identifiant : </label>
                <input type="text" name="username" id="username"> <br>

                <label for="email">Votre e-mail : </label>
                <input type="email" name="email" id="email"> <br>

                <label for="password">Votre mot de passe : </label>
                <input type="password" name="password" id="password"> <br>

                
                <label for="password">Confirmez votre mot de passe : </label>
                <input type="password" name="password2" id="password2">
            </div>

            <button type="submit" name="register"> S'inscrire</button>

        </form>
    </div><!--/.global-->

    <?php $content = ob_get_clean(); ?>
    <?php include 'template.php'; ?>



