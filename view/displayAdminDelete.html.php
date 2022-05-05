ETES VOUS SUR DE VOULOIR SUPPRIMER LE POST?

<form method="post" action="./index.php?controller=admin&action=doAdminDelete">
    
<?php echo '<td>'.'<a href="./index.php?controller=admin&action=doAdminDelete&id='.$post->id.'"> delete_post</a>'.'</td>';?>
</form>

<form method="post" action="./index.php?controller=admin&action=displayAdminList">
<p><input type="submit" class="button-blue left" value="non" /></p>
</form>
