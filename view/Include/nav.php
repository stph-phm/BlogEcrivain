<nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Blog de Jean Forteroch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Page d'accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=listArticles">Tous les chapitres </a>
            </li>
        </ul>

        <?php if ($isAdmin) { ?>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-nav"  href="index.php?action=dashboard">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nav" href="index.php?action=manageArticle">Gestion des chapitres <span
                        class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-nav" href="index.php?action=newArticle"><span>
                        <i class="fas fa-plus"> &nbsp;</i></span>Ajouter un chapitre </a>
            </li>
        <?php }  ?>
        <?php if ($isConnected) { ?>
            <li class="nav-item">
                <a class="nav-link text-nav" href="index.php?action=profil"><span>
                        <i class="fas fa-user">&nbsp;</i></span>Votre profile</a>
            </li>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="btn btn-outline-danger my-2 my-sm-0 text-nav" href="index.php?action=logout"><span>
                        <i class="fas fa-sign-out-alt"></i></span> &nbsp;Se déconnecter
                </a>
            </li>
        </ul>
        
        <?php } else { ?>

        <ul class="navbar-nav mr-sm-2">
            <li class="nav-item text-nowrap">
                <a class="btn btn-outline-primary my-2 my-sm-0 text-nav" href="index.php?action=login"><span>
                        <i class="fas fa-sign-in-alt"></i></span>&nbsp; Se connecter </a>
            </li>
        </ul>
        <?php }?>
    </div>
</nav>