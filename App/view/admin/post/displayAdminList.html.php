
<table class="table">
    <caption>List of  entities</caption>
    <thead>
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
                echo '<th scope="row">'. $post->getId().'</th>';
                echo '<td>'. $post->getTitle().'</td>';
                echo '<td>'. $post->getHeader().'</td>';
                echo '<td>'.'<a href="./index.php?controller=admin&entity=post&action=displayAdminUpdate&id='.$post->getId().'"> modif_post</a>'.'</td>';
                echo '<td>'.'<a href="./index.php?controller=admin&entity=post&action=displayAdminDelete&id='.$post->getId().'"> delete_post</a>'.'</td>';
            echo '</tr>';

            }?>
            <a href="./index.php?controller=admin&entity=post&action=displayAdminCreate"class="btn btn-primary btn-lg active"> Ajouter un post</a>
    </tbody>
</table>
