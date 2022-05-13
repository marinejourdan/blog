
<form method="post" action="./index.php?controller=user&action=doRegister">

    <tr><label>name<br /></label><input type="textarea" name="name" value="" size="250"> <tr/>
    </tr>
    <tr><label>first_name<br /></label><input type="textarea" name="first_name" value="" size="250"> <tr/>
    </tr>
    <tr><label>nickname<br /></label><input type="textarea" name="nickname" value="" size="250"> <tr/>
    </tr>
    <tr><label>email<br /></label><input type="textarea" name="email" value="" size="250"> <tr/>
    </tr>
    <tr><label>password<br /></label><input type="textarea" name="password" value="" size="250"> <tr/>
    </tr>
    <input type="hidden" name="enabled" value="0" />
    <input type="hidden" name="access" value="0" />

    <p><input type="submit" class="button-blue left" value="Ajouter mon User" /></p>

</form>
