<?php include('./view/part/displayMessage.html.php'); ?>

<h1> Mes articles </h1>
<div class="row">
    <?php foreach($params['postList'] as $post){ ?>
        <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><?php echo $post->getTitle();?></h4>
                <h6 class="card-text"><?php echo $post->getHeader();?></h6>
                <p class="card-text"><?php echo $post->getNicknameUser();?></p>
                <p class="card-text"><?php echo $post->getUpdated();?></p>
                <a href="index.php?controller=post&action=displayOne&id=<?php echo $post->getId(); ?>" class="btn btn-primary">
                    Voir l'article
                </a>
              </div>
            </div>
          </div>
    <?php } ?>
</div>
