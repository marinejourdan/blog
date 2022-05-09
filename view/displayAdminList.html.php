
<table class="table">
  <caption>List of  entities</caption>
        <thead>

            <a href="./index.php?controller=admin&action=displayAdminCreate"</a> Ajouter un post
            <tr>
                <th scope="col">id</th>
                <th scope="col">titre</th>
                <th scope="col">chapo</th>
                <th scope="col">modif</th>
                <th scope="col">suppression</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($postList as $post){
                echo '<tr>';
                    echo '<th scope="row">'. $post->id.'</th>';
                    echo '<td>'. $post->title.'</td>';
                    echo '<td>'. $post->header.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&action=displayAdminUpdate&id='.$post->id.'"> modif_post</a>'.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&action=displayAdminDelete&id='.$post->id.'"> delete_post</a>'.'</td>';
                echo '</tr>';

                }?>
        </tbody>
</table>





    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
