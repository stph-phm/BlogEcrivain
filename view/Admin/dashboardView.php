<?php $title = "Tableau de bord";  ?>
<?php ob_start(); ?>

<div class="container text-center">
     <div class="dashboard-area">
          <div class="dashboard-header mb-4">
               <h1 class="dashboard-header">Tableau de bord </h1>
               <h2 class="dashboard-header">Les commentaires signalés</h2>
          </div>
     </div>
</div>

<div class="container-fluid">
     <div class="dashboard-body">
          <table class="table">
               <thead class="table thead-dark">
                    <tr>
                         <th>#</th>
                         <th>Pseudo </th>
                         <th>Contenue du commentaire</th>
                         <th width="300">Action</th>
                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($reportedComments as $commentReported) { ?>
                    <tr>
                         <td><?= $i++  ?> </td>
                         <td><?= htmlspecialchars($commentReported['pseudo']) ?> </td>
                         <td> <?= nl2br(htmlspecialchars($commentReported['comment'])) ?> </td>
                         <td class="table-action">
                              <a href="index.php?action=validateReported&amp;id=<?= $commentReported['id'] ?>" class="btn btn-primary"> Valider <i class="fas fa-check"> </i> </a>

                              <a href="index.php?action=deleteCommentReport&amp;id= <?= $commentReported['id'] ?>" class="linkDelete btn btn-danger">Supprimer <i class="fas fa-times"> </i></a>
                         </td>
                    </tr>
                    <?php } ?>
               </tbody>
          </table>
     </div>
</div>




<?php $content = ob_get_clean(); ?>
<?php include 'view/template.php'; ?>