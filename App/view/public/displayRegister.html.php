<?php include('./view/part/displayMessage.html.php'); ?>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Créez votre compte</h1>
                            </div>

                            <form method="post" action="./index.php?controller=user&action=doRegister">

                            <form class="user">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>nom<br /></label><input type="text" name="name" value="" size="50"> <tr/>
                                        </tr>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>prénom<br /></label><input type="text" name="first_name" value="" size="50"> <tr/>
                                        </tr>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>surnom<br /></label><input type="text" name="nickname" value="" size="50"> <tr/>
                                        </tr>
                                    </div>

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>mot de passe<br /></label><input type="password" name="password" value="" size="50"> <tr/>
                                        </tr>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>confirmer le mot de passe<br /></label><input type="password" name="passwordVerify" value="" size="50"> <tr/>
                                        </tr>
                                    </div>

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>adresse email<br /></label><input type="text" name="email" value="" size="50"> <tr/>
                                        </tr>
                                    </div>
                                <p><input type="submit" class="button-blue" value="Ajouter mon User" /></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
