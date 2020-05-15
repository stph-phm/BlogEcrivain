<?php $title = "Tableau de bord ";  ?>
<?php ob_start(); ?>
<div class="global dashboard ">
    
    <h1>Bonjour</h1>
    <p><a href="index.php">Retour index</a></p>
    <div class="container-dashboard">

        <table class="table ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Appartien à quel titre de chapitre : </th>
                    <th> Contenue du commentaire : </th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dashboard as $commentReported) { ?>
                <tr>
                    <td> <?= $i++ ?></td>
                    <td> <?= htmlspecialchars($allArticles['title']) ?> </td>
                    <td> <?= nl2br(substr($allArticles['content'],0,150)) ?></td>
                    <td> <?= $allArticles['date_fr'] ?> </td>
                    <td width=500>
                        <form action="" method="post">
                            <button type="submit">Valider</button>
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>

                <?php 
                }   
                ?>
            </tbody>
        </table>
    </div>
</div>



<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>