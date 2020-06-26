<?php $title = "Tableau de bord ";  ?>
<?php ob_start(); ?>

<div class="Ajouter un nouvel article ">
    <div class="global">
        <h1>Bonjour </h1>
    <p><a href="index.php">Retour index</a></p>
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
                <?php 
                }   
                ?>
            </tbody>
        </table>
    </div>
</div>

    </div>
    


<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>