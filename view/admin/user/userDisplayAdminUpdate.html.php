
<?php
$errorsMessage['no_content']='merci de renseigner un contenu dans tous les champs';
?>

<?php
if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
?>
    <div class="errors">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error) {?>
                <li>
                    <?php
                    if(isset($errorsMessage[$error])){
                        echo $errorsMessage[$error];
                    }else{
                        echo $error;
                    }
                    ?>
                </li>
            <?php }?>
        </ul>
    </div>
<?php
    unset($_SESSION['errors']);
}
?>

<form method="post" action="./index.php?controller=admin&entity=user&action=doAdminUpdate">

    <input type="hidden" name="id" value="<?php echo $params['id'];?>"/>

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
    <tr>
    <tr> autorisation administration
        <div class="form-check">
            <input class="form-check-input" type="radio" name="access" id="0" value="1" checked>
            <label class="form-check-label" for="exampleRadios1">
                oui
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="access" id="1" value="0">
            <label class="form-check-label" for="exampleRadios2">
                non
            </label>
        </div>
    </tr>
    </tr>
    <tr>
        <tr> Autorisation commentaires
            <div class="form-check">
                <input class="form-check-input" type="radio" name="enabled" id="0" value="1" checked>
                <label class="form-check-label" for="exampleRadios1">
                    oui
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="enabled" id="0" value="0" checked>
                <label class="form-check-label" for="exampleRadios2">
                    non
                </label>
            </div>
        </tr>
    </tr>
    <p><input type="submit" class="button-blue left" value="ok"/></p>
</form>
