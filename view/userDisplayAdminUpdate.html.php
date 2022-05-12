
    <form method="post" action="./index.php?controller=admin&entity=user&action=doAdminUpdate">
        <input type="hidden" name="id" value="<?php echo $params['id'];?>" />

        <tr><label>nom<br /></label><input type="textarea" name="name" value="<?php echo $params['user']->name?>" size="250"> <tr/>
        </tr>
        <tr><label>prénom<br /></label><input type="textarea" name="first_name" value="<?php echo $params['user']->first_name ?>" size="250"> <tr/>
        </tr>
        <tr><label>surnom<br /></label><input type="textarea" name="nickname" value="<?php echo $params['user']->nickname ?>" size="250"> <tr/>
        </tr>
        <tr><label>email<br /></label><input type="textarea" name="email" value="<?php echo $params['user']->email ?>" size="250"> <tr/>
        </tr>
        <tr><label>password<br /></label><input type="textarea" name="password" value="<?php echo $params['user']->password ?>" size="250"> <tr/>
        </tr>
        <tr><label>access<br /></label><input type="textarea" name="access" value="<?php echo $params['user']->access ?>" size="250"> <tr/>
        </tr>

        <p><input type="submit" class="button-blue left" value="Mise à jour de l utilisateur" /></p>

    </form>
