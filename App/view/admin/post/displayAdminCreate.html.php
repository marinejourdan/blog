<?php include('./view/part/displayMessage.html.php'); ?>

<form method="post" action="./index.php?controller=admin&entity=post&action=doAdminCreate">

    <tr><label>title<br /></label><input type="textarea" name="title" value="" size="50"> <tr/>
    </tr>
    <tr><label>header<br /></label><input type="textarea" name="header" value="" size="100"> <tr/>
    </tr>
    <tr><label>content<br /></label><input type="textarea" name="content" value="" size="250"> <tr/>
    </tr>
    <p><input type="submit" class="btn btn-info" value="Poster mon article" /></p>


</form>