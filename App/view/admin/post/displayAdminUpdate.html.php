
<?php include('./view/part/displayMessage.html.php'); ?>


<form method="post" action="./index.php?controller=admin&entity=post&action=doAdminUpdate">
    <input type="hidden" name="id" value="<?php echo $params['post']->getid();?>" />

    <tr><label>title<br /></label><input type="textarea" name="title" value="<?php echo $params['post']->getTitle() ?>" size="250"> <tr/>
    </tr>
    <tr><label>header<br /></label><input type="textarea" name="header" value="<?php echo $params['post']->getHeader() ?>" size="250"> <tr/>
    </tr>
    <tr><label>content<br /></label><input type="textarea" name="content" value="<?php echo $params['post']->getContent() ?>" size="250"> <tr/>
    </tr>
    <p><input type="submit" class="button-blue left" value="Mise à jour de l'article" /></p>

</form>
