
<?php include('./view/part/displayMessage.html.php'); ?>

<form method="post" action="./index.php?controller=admin&entity=user&action=doAdminUpdate">

    <input type="hidden" name="id" value="<?php echo $params['id'];?>"/>

    <tr>
        <td><label>nom</label></td>
        <td><input type="text" name="name" value="<?php echo $params['user']->getName()?>" size="250"></td>
    <tr/>
    <tr>
        <td><label>prénom</label></td>
        <td><input type="text" name="first_name" value="<?php echo $params['user']->getFirstName() ?>" size="250"></td>
    <tr/>
    <tr>
        <td><label>surnom</label></td>
        <td><input type="text" name="nickname" value="<?php echo $params['user']->getNickname() ?>" size="250"></td>
    <tr/>
    <tr>
        <td><label>email</label></td>
        <td><input type="text" name="email" value="<?php echo $params['user']->getEmail() ?>" size="250"></td>
    <tr/>
    <tr>
        <td><label>modifier le mot de passe</label></td>
        <td>
            <input type="password" name="plain_password" size="250">
            <input type="hidden" name="password" value="<?php echo $params['user']->getPassword() ?>" >
        </td>
    <tr/>
    <tr>
    <tr> autorisation administration

    <input class="form-check-input" type="radio" name="access" value="1" checked>
    <label class="form-check-label" for="exampleRadios1">
        oui
    </label>

    <input class="form-check-input" type="radio" name="access" value="0">
    <label class="form-check-label" for="exampleRadios2">
        non
    </label>

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
