
<?php
echo 'prout'

?>
<h1> Bienvenue sur l'admin</h1>

<h2> Tableau des posts et des commentaires</h2>

<table>
    <tr>
        <th>titre</th>
        <th>chapo</th>
        <th>contenu</th>
        <th>action</th>
        <th>modif</th>
        <th>suppression</th>

    </tr>
    <?php foreach($data as $post){
        echo '<tr>';
            echo '<td>'.'id'.'</td>';
            echo '<td>'.'commentaire'.'</td>';
            echo '<td>'. 'header' .'</td>';
            echo '<td>'. 'content' .'</td>';
            echo '<td>'.'<a href="postpoo.php?id='.$post['id'].'"> lien post POO</a>'.'</td>';
            echo '<td>'.'<a href="show_post.php?id='.$post['id'].'"> lien post </a>'.'</td>';
            echo '<td>'.'<a href="modif_post.php?id='.$post['id'].'"> modif_post</a>'.'</td>';
            echo '<td>'.'<a href="delete_post.php?id='.$post['id'].'"> delete_post</a>'.'</td>';
        echo '</tr>';
        }
    ?>
</table>
</div>
<h2> Tableau des utilisateurs</h2>
