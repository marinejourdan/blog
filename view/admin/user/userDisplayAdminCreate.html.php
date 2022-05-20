
<form method="post" action="./index.php?controller=admin&entity=user&action=doAdminCreate">

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
    <tr>
        <tr> autorisation administration
            <div class="form-check">
                <input class="form-check-input" type="radio" name="access" id="1" value="1" checked>
                <label class="form-check-label" for="exampleRadios1">
                oui
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="access" id="0" value="0">
                <label class="form-check-label" for="exampleRadios2">
                non
                </label>
            </div>
        </tr>
    </tr>
    <tr>
       <tr> Autorisation commentaires
           <div class="form-check">
               <input class="form-check-input" type="radio" name="enabled" id="1" value="1" checked>
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

    <p><input type="submit" class="button-blue left" value="Ajouter mon User" /></p>

</form>
