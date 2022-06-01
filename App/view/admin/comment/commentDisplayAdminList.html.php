
<table class="table">
  <caption>List of  entities</caption>
        <thead>
            <tr>
                <th scope="col">content</th>
                <th scope="col">post</th>
                <th scope="col">surnom</th>
                <th scope="col">publication</th>

            </tr>
        </thead>

        <tbody>
            <?php foreach($params['commentList'] as $comment){
                echo '<tr>';
                    echo '<td>'. $comment->getContent().'</td>';
                    echo '<td>'. $comment->getPost().'</td>';
                    echo '<td>'. $comment->getNicknameUser().'</td>';
                    echo '<td>'. $comment->getPublication().'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=comment&action=displayAdminDelete&id='.$comment->getId().'"> delete_comment</a>'.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=comment&action=displayAdminUpdate&id='.$comment->getId().'"> modif_comment</a>'.'</td>';
                echo '</tr>';

                }?>
        </tbody>
</table>
