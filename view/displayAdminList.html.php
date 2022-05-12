
<table class="table">
  <caption>List of  entities</caption>
        <thead>

            <a href="./index.php?controller=admin&entity=post&action=displayAdminCreate"</a> Ajouter un post
            <tr>
                <th scope="col">id</th>
                <th scope="col">titre</th>
                <th scope="col">chapo</th>
                <th scope="col">modif</th>
                <th scope="col">suppression</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($params['postList'] as $post){
                echo '<tr>';
                    echo '<th scope="row">'. $post->id.'</th>';
                    echo '<td>'. $post->title.'</td>';
                    echo '<td>'. $post->header.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=post&action=displayAdminUpdate&id='.$post->id.'"> modif_post</a>'.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=post&action=displayAdminDelete&id='.$post->id.'"> delete_post</a>'.'</td>';
                echo '</tr>';

                }?>
        </tbody>
</table>
