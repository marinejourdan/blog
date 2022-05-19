<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">connexion</h1>
                            </div>
                            <form method="post" action="./index.php?controller=user&action=doLogin"
                            >
                                <?php

                                $errorsMessage['no_mail']='merci de renseigner un mail';
                                $errorsMessage['no_pass']= 'merci de renseigner un mot de passe';
                                $errorsMessage['no_account']= 'ce compte est inexistant';
                                $errorsMessage['waiting_account']='votre compte est en attente d activation, merci de patienter';
                                $errorsMessage['email_invalid']="L'adresse email n'est pas valide.";
                                ?>
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
                                                <li><?php echo $errorsMessage[$error];?></li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                <?php } ?>

                                <label>mail</label></br><input type="email" name="email" value="<?php echo $last_email; ?>" size="60"  placeholder="Votre adresse email ici" /></br>
                                <label>Mot de passe</label></br><input type="password" name="password"  value="" size="60"></p>

                                <button type="submit" class="btn btn-primary btn-block">se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
