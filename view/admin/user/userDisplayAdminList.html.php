<?php include('./view/part/displayMessage.html.php'); ?>

<table class="table">
  <caption>List of  entities</caption>
        <thead>

            <a href="./index.php?controller=admin&entity=user&action=displayAdminCreate"</a> Ajouter un user
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">first_name</th>
                <th scope="col">nickname</th>
                <th scope="col">email</th>
                <th scope="col">access</th>
                <th scope="col">enabled</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($params['userList'] as $user){
                echo '<tr>';
                    echo '<th scope="row">'. $user->id.'</th>';
                    echo '<td>'. $user->name.'</td>';
                    echo '<td>'. $user->first_name.'</td>';
                    echo '<td>'. $user->nickname.'</td>';
                    echo '<td>'. $user->email.'</td>';
                    echo '<td>'. $user->access.'</td>';
                    echo '<td>'. $user->enabled.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=user&action=displayAdminUpdate&id='.$user->id.'"> modif_user</a>'.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=user&action=displayAdminDelete&id='.$user->id.'"> delete_user</a>'.'</td>';
                echo '</tr>';

                }?>
        </tbody>
</table>
