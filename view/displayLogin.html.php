<form method="post" action="./index.php?controller=user&action=doLogin">

    <?php
        $last_email='';
        if (isset($_SESSION['last_email'])){
            $last_email=$_SESSION['last_email'];
        }
    ?>

    <?php if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){ ?>
        <div class="errors">
            <ul>
            <?php foreach ($_SESSION['errors'] as $error) {?>
                <li><?php echo $error;?></li>
            <?php }?>
            </ul>
        </div>
    <?php } ?>

    <label>mail<br /></label><input type="email" name="email" value="<?php echo $last_email; ?>" size="30"  placeholder="Votre adresse email ici" />
    <label>Mot de passe<br /></label><input type="password" name="password"  value="" size="8"></p>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
