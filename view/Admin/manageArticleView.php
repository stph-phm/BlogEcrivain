<?php $title = "Gestion des chapitres ";  ?>
<?php ob_start(); ?>

<div class="global manage_article ">
<?php if(isset($_SESSION['success'])) { ?>
    <div class="alert alert-success text-center"> <?= $_SESSION['success'] ?> </div>
<?php unset($_SESSION['success']) ?>

<?php } elseif(isset($_SESSION['error'])) { ?>

    <div class="alert alert-danger text-center"> <?= $_SESSION['error'] ?> </div>
    <?php unset($_SESSION['error']) ?>
<?php } elseif(isset($_SESSION['info'])) { ?>

    <div class="alert alert-info text-center" role="alert"> <?= $_SESSION['info'] ?></div>
    <?php unset($_SESSION['info']) ?>
<?php }  ?>

    <h1 class="text-center">Gestion des articles </h1>
    <table class="table">
        <thead class="table">
            <tr>
                <th>#</th>
                <th>titre du chapitre </th>
                <th> Contenue de l'article </th>
                <th>Date de publication</th>
                <th width=300>Action </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) { ?>
            <tr>
                <td> <?= $i++ ?></td>
                <td><?= htmlspecialchars($article['title']) ?> </td>
                <td><?= nl2br(substr($article['content'], 0, 150)) ?> </td>
                <td> <?= date_format(date_create($article['date_article']), 'd/m/Y') ?> </td>
                <td class="table-action" width=500>
                    <a href="index.php?action=article&amp;id= <?= $article['id'] ?>" class="btn btn-secondary"><span> <i
                                class="fas fa-eye"></i>&nbsp;
                        </span> Voir </a>

                    <a href="index.php?action=edit&amp;id= <?= $article['id'] ?>" class="btn btn-primary"><span> <i
                                class="fas fa-pencil-alt"></i> &nbsp;
                        </span> Modifier </a>

                    <a href="index.php?action=deleteArticle&amp;id= <?= $article['id'] ?>"
                        class="linkDelete btn btn-danger" id="linkDelete"><span>
                            <i class="fas fa-times"></i> &nbsp;
                        </span> Supprimer </a>
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