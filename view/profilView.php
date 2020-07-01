<?php $title = "Profile" ?>

<?php ob_start(); ?>


<div class="global">
    <div class="part-info-user">
        <h1>Bonjour <?= $userInfo['username'] ?></h1>

        <p>adresse mail : <?= $userInfo['email_user'] ?></p>
        <p>date de creation : <?= date_format(date_create($userInfo['date_user']), 'd/m/Y à H:i') ?> </p>
    </div>

    <?php if ($userInfo['is_admin'] == 1) { ?>
    <div class="container-dashboard">
        <div class="title-table">
            <h2 class="text-center mb-3">Les commentaires signalée</h2>
        </div>

        <div class="table-report-com">
            <table class="table">
                <thead class="table">
                    <tr>
                        <th>#</th>
                        <th>Pseudo</th>
                        <th>Contenue du commentaire</th>
                        <th width="300">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($listCommentsReport as $listReported) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($listReported['pseudo']) ?></td>
                        <td><?= nl2br($listReported['comment']) ?></td>
                        <td class="table-action">
                            <a href="index.php?action=validateReported&amp;id=<?= $listReported['id'] ?>"  class="btn btn-primary"> Valider <i class="fas fa-check"> </i></a>

                            <a href="index.php?action=deleteCommentReport&amp;id= <?= $listReported['id'] ?>"
                                class="btn btn-danger">Supprimer <i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>

    <?php } ?>
</div>



<?php $content = ob_get_clean(); ?>
<?php include 'template.php'; ?>