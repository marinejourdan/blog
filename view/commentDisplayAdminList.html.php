
<table class="table">
  <caption>List of  entities</caption>
        <thead>
            <tr>
                <th scope="col">post</th>
                <th scope="col">content</th>
                <th scope="col">surnom</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($commentList as $comment){
                echo '<tr>';

                    echo '<td>'. $comment->post.'</td>';
                    echo '<td>'. $comment->content.'</td>';
                    echo '<td>'. $comment->nickname_user.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=comment&action=displayAdminDelete&id='.$comment->id.'"> delete_comment</a>'.'</td>';
                echo '</tr>';

                }?>
        </tbody>
</table>
