<?php $title = "Gestion des chapitres ";  ?>
<?php ob_start(); ?>

<div class="global manage_article ">
    <h1 class="text-center gestionArticle">Gestion des articles </h1>
    <table class="manageArticle table">
        <thead class=" table thead-dark">
            <tr>
                <th class=" title-form-article text-center align-midle ">Nbre de charpitre</th>
                <th class=" title-form-article text-center align-midle">titre du chapitre </th>
                <th class=" title-form-article text-center align-midle"> Contenue de l'article </th>
                <th class=" title-form-article text-center align-midle">Date de publication</th>
                <th class=" title-form-article text-center align-midle" width=300>Action </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) { ?>
            <tr>
                <td class="text-center"> <?= $i++ ?></td>
                <td width=200><?= htmlspecialchars($article['title']) ?> </td>
                <td><?= mb_substr($article['content'], 0, 150) ?>... </td>
                <td> <?= date_format(date_create($article['date_article']), 'd/m/Y') ?> </td>

                <td class="table-action">
                    <a href="index.php?action=article&amp;id= <?= $article['id'] ?>" class="btn btn-secondary">
                        <span><i class="fas fa-eye"></i>&nbsp; </span> Voir </a>

                    <a href="index.php?action=edit&amp;id= <?= $article['id'] ?>" class="btn btn-primary">
                    <span> <i class="fas fa-pencil-alt"></i> &nbsp;</span> Modifier </a>

                    <a href="index.php?action=deleteArticle&amp;id= <?= $article['id'] ?>" class="linkDelete btn btn-danger" id="linkDelete">
                        <span> <i class="fas fa-times"></i> &nbsp;</span> Supprimer </a>
                </td>
            </tr>
            <?php 
                }   
                ?>
        </tbody>
    </table>

</div>
<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>