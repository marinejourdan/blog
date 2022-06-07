
<?php include('./view/part/displayMessage.html.php'); ?>

<form method="post" action="./index.php?controller=admin&entity=comment&action=doAdminUpdate">
    <input type="hidden" name="id" value="<?php echo $params['id'];?>"/>

    <tr> autorisation publication
        <div class="form-check">
            <input class="form-check-input" type="radio" name="publication" id="0" value="0" checked>
            <label class="form-check-label" for="exampleRadios1">
                non
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="publication" id="1" value="1">
            <label class="form-check-label" for="exampleRadios2">
                oui
            </label>
        </div>
    </tr>
    </tr>
    <tr>
    <p><input type="submit" class="button-blue left" value="ok"/></p>
</form>
