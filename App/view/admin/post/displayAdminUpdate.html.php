<?php include('./view/part/displayMessage.html.php'); ?>

<form method="post" action="./index.php?controller=admin&entity=post&action=doAdminUpdate">
<table>
    <tr>
        <td><label>title</label></td><td><input type="text" name="title" value="<?php echo $params['post']->getTitle() ?>" size="50"></td>
    </tr>
    <tr>
        <td><label>header</label></td><td><textarea name="header" rows="4" cols="50"><?php echo $params['post']->getHeader() ?></textarea></td>
    </tr>
    <tr>
        <td><label>content</label></td><td><textarea name="content" rows="4" cols="50"><?php echo $params['post']->getContent() ?></textarea></td>
    </tr>
</table>
<input type="hidden" name="id" value="<?php echo $params['post']->getid();?>" />
<p><input type="submit" class="btn btn-info" value="Poster mon article" /></p>
</form>
