<?php $title = "Tableau de bord";  ?>
<?php ob_start(); ?>
    <div class="dashboard-content">
        <h1>Bonjour <?=  $userInfo['username'] ?></h1>
        <h2>Gestion des commentaires signalées</h2>

        <table class="table">
            <thead class="table">
            <tr>
                <th>#</th>
                <th>Pseudo </th>
                <th wi> Contenue du commentaire </th>
                <th width=300>Action </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($listCommentsReport as $commentReported) { ?>
                <tr>
                    <td> <?= $i++ ?></td>
                    <td> <?= htmlspecialchars($commentReported['pseudo']) ?> </td>
                    <td> <?= nl2br(substr($commentReported['comment'],0,150)) ?></td>
                    <td class="table-action">
                        <a href="index.php?action=validateReported&amp;id=<?= $commentReported['id'] ?>"
                           class="btn btn-primary"> Valider <i class="fas fa-check"> </i></a>

                        <a href="index.php?action=deleteCommentReport&amp;id= <?= $commentReported['id'] ?>"
                           class="btn btn-danger">Supprimer <i class="fas fa-times"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
    </div>

<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>