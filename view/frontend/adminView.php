<?php $title = "Tableau de bord ";  ?>
<?php ob_start(); ?>

<h1>Bonjour</h1>
<div class="container-dashboard">

    <table>
        <thead>
            <tr>
                <th>#</th>
                <tr>Titre du chapitre </tr>
                <tr>Extrait du chapitre  </tr>
                <tr>Date de la création</tr>
                <tr>Action </tr>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($dashboard as $allArticles) { ?>    
        <tr>
            <td> <?= htmlspecialchars($dashboard['title']) ?> </td>
            <td> <?= nl2br(substr($dashboard['content'],0,150)) ?></td>
            <td> <?= $dashboard['date_fr'] ?> </td>
            <td width=500> 
                <a href="#"> Voir </a>
                <a href="#"> Modifier </a>
                <a href="#"> Supprimer </a>
            </td>
        </tr>   

            <?php 
            }
            ?>
        </tbody>
    </table>
</div> 

<?php $content = ob_get_clean(); ?>
<?php include 'template.php'; ?>