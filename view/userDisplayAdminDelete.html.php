ETES VOUS SUR DE VOULOIR SUPPRIMER LE USER?

<form method="post" action="./index.php?controller=admin&entity=user&action=doAdminDelete">

<input type="hidden" name="id" value="<?php echo $id;?>" />
<p><input type="submit" class="button-blue left" value="oui" /></p>
</form>
