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
                    echo '<th scope="row">'. $user->getId().'</th>';
                    echo '<td>'. $user->getName().'</td>';
                    echo '<td>'. $user->getFirstName().'</td>';
                    echo '<td>'. $user->getNickname().'</td>';
                    echo '<td>'. $user->getEmail().'</td>';
                    echo '<td>'. $user->getAccess().'</td>';
                    echo '<td>'. $user->getEnabled().'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=user&action=displayAdminUpdate&id='.$user->getId().'"> modif_user</a>'.'</td>';
                    echo '<td>'.'<a href="./index.php?controller=admin&entity=user&action=displayAdminDelete&id='.$user->getId().'"> delete_user</a>'.'</td>';
                echo '</tr>';

                }?>
        </tbody>
</table>
