

<table>

<a href="./index.php?controller=admin&action=displayAdminCreate"</a> Ajouter un post
    <tr>
        <th>id</th>
        <th>titre</th>
        <th>chapo</th>


        <th>modif</th>
        <th>suppression</th>

    </tr>
    <?php foreach($postList as $post){
        echo '<tr>';
            echo '<td>'. $post->id.'</td>';
            echo '<td>'. $post->title.'</td>';
            echo '<td>'. $post->header.'</td>';

            echo '<td>'.'<a href="./index.php?controller=admin&action=displayAdminUpdate&id='.$post->id.'"> modif_post</a>'.'</td>';
            echo '<td>'.'<a href="./index.php?controller=admin&action=displayAdminDelete&id='.$post->id.'"> delete_post</a>'.'</td>';
        echo '</tr>';

        }
    ?>
</table>
</div>
