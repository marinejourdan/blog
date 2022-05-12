
<div class="row">

        <h2 class="title"><?php echo $params['post']->title;?></h2>
        <h3 class="text"><?php echo $params['post']->header;?></h3>
        <p class="text"><?php echo $params['post']->content;?></p>
        <p class="text"><?php echo $params['post']->nickname_user;?></p>
        <p class="text"><?php echo $params['post']->updated;?></p>
</div>

<div class="row">
    <?php foreach($params['commentList'] as $comment){?>
        <h2 class="title"> <?php echo $comment->content;?> </h2>
        <p class="title"><?php echo $comment->nickname_user;?></p>
        <p class="title"><?php echo $comment->creation_date;?></p>
    <?php }?>


    <h3>Poster un commentaire</h3>
    <form method="post" action="./index.php?controller=comment&action=doComment">
    	<input type="hidden" name="id_post" value="<?php echo $params['post']->id;?>" />
    	<p>Commentaire<br /><textarea name="content"></textarea></p>
    	<p><input type="submit" class="button-blue left" value="Poster mon commentaire" /></p>
    	<p class="red right">Votre adresse e-mail n'est pas publiée lorsque vous ajoutez un commentaire.</p>
    </form>

</div>
