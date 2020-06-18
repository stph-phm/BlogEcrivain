<?php $title = "Profile" ?>

<?php ob_start(); ?>


<div class="global">
    <?php if ($isConnect) { ?>
    <h1 class="text-center mb-4">Bonjour <?= $userInfo['username'] ?> </h1>

    <p class="text-center">adresse mail : <?= $userInfo['email_user'] ?></p>
    <p class="text-center">date de creation : <?= date_format(date_create($userInfo['date_user']), 'd/m/Y à H:i') ?> </p>
</div>

        <?php if ($userInfo['is_admin'] == 1) { ?>
            <div class="Ajouter un nouvel article ">
                <div class="global">
                    <div class="container-dashboard">
                        <div class="title_admin">
                            <h2 class="text-center mb-2">Les commentaires signalée </h2>
                        </div>

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
                                <?php foreach ($listCommentsReport as $listReported) { ?>
                                <tr>
                                    <td> <?= $i++ ?></td>
                                    <td> <?= htmlspecialchars($listReported['pseudo']) ?> </td>
                                    <td> <?= nl2br(substr($listReported['comment'],0,150)) ?></td>
                                    <td class="table-action">
                                        <a href="index.php?action=validateReported&amp;id=<?= $listReported['id'] ?>"
                                            class="btn btn-primary"> Valider <i class="fas fa-check"> </i></a>

                                        <a href="index.php?action=deleteCommentReport&amp;id= <?= $listReported['id'] ?>"
                                            class="btn btn-danger">Supprimer <i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php } ?> 
    <?php } ?>

<?php $content = ob_get_clean(); ?>
<?php include 'template.php'; ?>