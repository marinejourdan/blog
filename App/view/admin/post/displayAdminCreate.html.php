<?php include('./view/part/displayMessage.html.php'); ?>

<form method="post" action="./index.php?controller=admin&entity=post&action=doAdminCreate">
<table>
    <tr>
        <td><label>title</label></td><td><input type="text" name="title" value="" size="50"></td>
    </tr>
    <tr>
        <td><label>header</label></td><td><textarea name="header" value="" rows="4" cols="50"></textarea></td>
    </tr>
    <tr>
        <td><label>content</label></td><td><textarea name="content" value="" rows="4" cols="50"></textarea></td>
    </tr>
</table>
<p><input type="submit" class="btn btn-info" value="Poster mon article" /></p>
</form>
