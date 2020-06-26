<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Blog de Jean Forteroch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Tous les chapires
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <?php 
                    foreach ($listArticle as $allArticle) { ?>

                    <a class="dropdown-item"
                        href="index.php?action=article&amp;id=<?= $allArticle['id'] ?>"><?= htmlspecialchars($allArticle['title']) ?></a>

                    <?php }?>
                </div>
            </li>
        </ul>


        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=manageArticle">Gestion des chapitres <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=newArticle"><span>
                        <i class="fas fa-plus"> &nbsp;</i></span>Ajouter un chapitre </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=profil"><span>
                        <i class="fas fa-user">&nbsp;</i></span>Votre profile</a>
            </li>
        </ul>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="btn btn-outline-primary my-2 my-sm-0" href="index.php?action=login"><span>
                        <i class="fas fa-sign-in-alt"></i></span>&nbsp; Se connecter </a>
            </li>
        </ul>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="btn btn-outline-danger my-2 my-sm-0" href="index.php?action=logout"><span>
                        <i class="fas fa-sign-out-alt"></i></span> &nbsp;Se déconnecter
                </a>
            </li>
        </ul>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
    </div>
</nav>