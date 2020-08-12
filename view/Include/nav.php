<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Blog Jean Forteroche</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto text-center">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Page d'accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?action=listArticles">Tous les chapitres <span class="sr-only">(current)</span></a>
            </li>
            <?php if ($this->isAdmin) { ?>
                <li class="nav-item">
                    <a class="nav-link text-nav"  href="index.php?action=dashboard">Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-nav" href="index.php?action=manageArticle">Gestion des chapitres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-nav" href="index.php?action=newArticle"><span>
                        <i class="fas fa-plus"> &nbsp</i></span>Ajouter un chapitre </a>
                </li>
            <?php } ?>
            <?php if ($this->isConnected) {  ?>
                <li class="nav-item">
                    <a class="nav-link text-nav" href="index.php?action=profil"><span>
                        <i class="fas fa-user">&nbsp;</i></span>Votre profil</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-danger my-2 my-sm-0 text-nav" href="index.php?action=logout"><span>
                        <i class="fas fa-sign-out-alt"></i></span> &nbsp;Se déconnecter
                    </a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="btn btn-outline-primary my-2 my-sm-0 text-nav" href="index.php?action=login"><span>
                        <i class="fas fa-sign-in-alt"></i></span>&nbsp; Se connecter
                    </a>
            <?php } ?>
        </ul>
    </div>
</nav>













