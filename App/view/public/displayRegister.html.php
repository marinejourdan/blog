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
                                        <tr><label>name<br /></label><input type="textarea" name="name" value="" size="50"> <tr/>
                                        </tr>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>first_name<br /></label><input type="textarea" name="first_name" value="" size="50"> <tr/>
                                        </tr>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>nickname<br /></label><input type="textarea" name="nickname" value="" size="50"> <tr/>
                                        </tr>
                                    </div>

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>password<br /></label><input type="textarea" name="password" value="" size="50"> <tr/>
                                        </tr>
                                    </div>

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <tr><label>email<br /></label><input type="textarea" name="email" value="" size="50"> <tr/>
                                        </tr>
                                    </div>

                                    <input type="hidden" name="enabled" value="0" />
                                    <input type="hidden" name="access" value="0" /><br />
                                <p><input type="submit" class="button-blue" value="Ajouter mon User" /></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
