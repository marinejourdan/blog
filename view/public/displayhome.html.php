
<h1> Mes dernieres actus</h1>

<div class="row">
    <?php foreach($params['lastPosts'] as $post){ ?>
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><?php echo $post->title;?></h4>
                <p class="card-text"><?php echo $post->header;?></p>
                <p class="card-text"><?php echo $post->nickname_user;?></p>
                <p class="card-text"><?php echo $post->updated;?></p>
                <a href="index.php?controller=post&action=displayOne&id=<?php echo $post->id; ?>" class="btn btn-primary">
                    Voir l'article
                </a>
              </div>
            </div>
          </div>
    <?php } ?>
</div>
