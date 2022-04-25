
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



    <!-- <h3>Poster un commentaire</h3>
        <form method="post" action="<?php ?>">
	<input type="hidden" name="action" value="poster-commentaire" />
	<input type="text" name="email" class="hidden" />
	<p>Commentaire<br /><textarea name="content"></textarea></p>
	<p>Nom<br /><input type="text" name="nickname" /></p>
	<p>Adresse e-mail<br /><input type="text" name="emailtrue" /></p>
	<p><input type="submit" class="button-blue left" value="Poster mon commentaire" /></p>
    <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>" />
	<p class="red right">Votre adresse e-mail n'est pas publiée lorsque vous ajoutez un commentaire.<br />Tous les champs sont obligatoires pour soumettre votre commentaire.</p>
-->

</div>
