
<?php include('./view/part/displayMessage.html.php'); ?>

<div class="container">
    <div class="card" style="width: 55rem;">
        <h2><?php echo $params['post']->getTitle();?></h2>
        <div class="card-header">
            <span> Published <p class="text"><?php echo $params['post']->getUpdated();?></p> by</span>
            <a href="" class="text-dark"><p class="text"><?php echo $params['post']->getNicknameUser();?></p></a>
        </div>

        <div class="card-body">
            <h6 class="text"><?php echo $params['post']->getHeader();?></h6>
            <p class="text"><?php echo $params['post']->getContent();?></p>

            <?php foreach($params['commentList'] as $comment){?>
                <p class="mb-2"><strong><?php echo $comment->getNicknameUser();?></strong></p>
                <p class="title"> <?php echo $comment->getContent();?> </p>
                <p class="title"><?php echo $comment->getCreationDate();?></p>
            <?php }?>
        </div>

        <div class="card-footer">
            <h3>Poster un commentaire</h3>
            <form method="post" action="./index.php?controller=comment&action=doComment">

                <input type="hidden" name="id_post" value="<?php echo $params['post']->getId();?>"/>
                <p>Commentaire<br/><textarea name="content"></textarea></p>
                <p><input type="submit" class="button-blue left" value="Poster mon commentaire"/></p>
            </form>
        </div>
    </div>
    </div>
