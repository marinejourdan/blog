<?php include('./view/part/displayMessage.html.php'); ?>
<h1> Mes dernieres actus</h1>

<div class="row">
    <?php foreach($params['lastPosts'] as $post){ ?>
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><?php echo $post->getTitle();?></h4>
                <p class="card-text"><?php echo $post->getHeader();?></p>
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
