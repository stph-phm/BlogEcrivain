<?php $title = htmlspecialchars($article['title']); ?>
<?php ob_start(); ?>

<div class="articleGlobal">
    <div class="HeaderArticle">
        <div class="part">
            <p><a href="index.php?action=listArticles">Retour à la liste des chapitres:</a></p>
        </div>

        <div class="partArticle jumbotron jumbotron-fluid">
            <div class="ArticleTitle">
                <h1 class="ArticleTitle text-center mb-4"> <?= htmlspecialchars($article['title']) ?> </h1>
            </div>

            <div class="ArticleContent">
                <p class="ArticleContent"> <?= nl2br($article['content']) ?> </p>
                <p class="ArticleContent text-right"> publié le :
                    <?=  date_format(date_create($article['date_article']), 'd/m/Y à H:i') ?></p>
            </div>
        </div>
    </div>

    <?php
    if ($this->isConnected) { ?>
    <section class="container">
        <h2>Commentaire</h2>

        <form class="mb-4" action="index.php?action=addComment&amp;id= <?= $article['id']?>" method="POST">
            <div class="form-group">
                <label for="comment">Commentaire</label>
                <textarea id="mytextarea" class="form-control" rows="3" name="comment"></textarea>
            </div>
            <input type="submit" class="btn btn-primary mb-4" value="Commentez">
        </form>
        <?php } else { ?>

        <div class="jumbotron">
            <p class="lead text-center"> <a href="index.php?action=login" class="text-center">Connectez-vous pour
                    pouvoir commenter</a>
            </p>
        </div>

        <?php  } ?>
        <?php if(isset($errorMsg)) { ?>
        <div class="alert alert-danger text-center"> <?= $errorMsg ?> </div>
        <?php } ?>

        <?php foreach ($listComment as $comment) { ?>
        <div class="container">
            <div class="d-flex">
                <p>
                    <strong> <?= $comment['pseudo'] ?> </strong>
                    <?= date_format(date_create($comment['date_comment']), 'd/m/Y à H:i') ?> : &nbsp;
                </p>

                <p>
                    <?php if ($comment['reported'] == 0) { ?>

                    <a class="buttonlink btn btn-secondary btn-sm mr-2"
                        href="index.php?action=reportComment&amp;id= <?= $comment['id'] ?>"
                        title="Signaler le commentaire"><span><i class="fas fa-flag"></i></span>&nbsp;</a>

                    <?php if ($this->isAdmin) { ?>
                    <a class="linkDelete buttonlink  btn btn-danger btn-sm "
                        href="index.php?action=deleteComment&amp;id= <?= $comment['id'] ?>">
                        <i class="fas fa-minus-circle"></i>
                    </a>
                    <?php }  ?>
                </p>

                <?php } else { ?>
                <p class="text-danger mr-2"><span><i class="fas fa-flag"></i></span>&nbsp;</p>
                <?php if($this->isAdmin)  { ?>
                <a class="linkDelete buttonlink  btn btn-danger btn-sm "
                    href="index.php?action=deleteComment&amp;id= <?= $comment['id'] ?>">
                    <i class="fas fa-minus-circle"></i>
                </a>
                <?php } ?>
                <?php } ?>
            </div>

            <p> <?=  $comment['comment'] ?> </p>
            <hr>
        </div>
        <?php } ?>
    </section>
</div>



<?php $content = ob_get_clean(); ?>

<?php include 'view/template.php'; ?>