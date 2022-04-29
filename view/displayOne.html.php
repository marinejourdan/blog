
<div class="row">

        <h2 class="title"><?php echo $post->title;?></h2>
        <h3 class="text"><?php echo $post->header;?></h3>
        <p class="text"><?php echo $post->content;?></p>
        <p class="text"><?php echo $post->nickname_user;?></p>
        <p class="text"><?php echo $post->updated;?></p>
</div>

<div class="row">
    <?php foreach($commentList as $comment){?>
        <h2 class="title"> <?php echo $comment->content;?> </h2>
        <p class="title"><?php echo $comment->nickname_user;?></p>
        <p class="title"><?php echo $comment->creation_date;?></p>
    <?php }?>


    <h3>Poster un commentaire</h3>
    <form method="post" action="./index.php?controller=comment&action=doComment">
    	<input type="hidden" name="id_post" value="<?php echo $post->id;?>" />
    	<p>Commentaire<br /><textarea name="content"></textarea></p>
    	<p><input type="submit" class="button-blue left" value="Poster mon commentaire" /></p>
        <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>" />
    	<p class="red right">Votre adresse e-mail n'est pas publiée lorsque vous ajoutez un commentaire.<br />Tous les champs sont obligatoires pour soumettre votre commentaire.</p>
    </form>

</div>
