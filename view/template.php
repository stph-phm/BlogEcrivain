<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- VIEWPORT -->
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- FONTAWASOME -->
    <script src="https://kit.fontawesome.com/effe484f35.js" crossorigin="anonymous"></script>

    <!-- BOOTSRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- TINIMCE -->
    <script src="https://cdn.tiny.cloud/1/zxws6oho4y58ubsdfptbp4gb3420xahucxayj6amm3ptdqxt/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/queries.css">

    <title> <?= $title ?></title>
</head>

<body>
    <?php include 'Include/nav.php'; ?>

    <?php if(isset($errorMsg)) { ?>
    <div class="alert alert-danger text-center"> <?= $errorMsg ?> </div>
    <?php } ?>



    <?php
    $flashMessages = $this->displayFlash;

    if (!empty($flashMessages)) {
        foreach ($flashMessages as $flash) { ?>
            <div class="alert alert-<?=$flash['type'] ?> text-center"> <?= $flash['message'] ?> </div>
        <?php }
    }
    ?>
    <?= $content ?>

    <?php include 'Include/footer.php'; ?>

    <!-- JS BOOSTRAP -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <!-- FILE JS -->
    <script src="public/js/app.js"></script>

</body>

</html>