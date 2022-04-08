<?php
include_once('./Manager/manager.php');
include_once('./Classe/Post.php');
include_once('./Classe/User.php');
include_once('./Classe/Comment.php');


//var_dump($_GET);

// ROUTER
if (count($_GET)==0){
    include_once('./Controller/homeController.php');
    displayHome();
}else{
    $controller=$_GET['controller'];
    $action=$_GET['action'];

    if ($controller == 'post'){
        include_once('./Controller/postController.php');
        if ($action == 'displayList'){
            displayList();
        }elseif($action == 'displayOne'){
            displayOne();
        }elseif($action == 'doComment'){
            doComment();
        }
    }
    if ($controller == 'home'){
        include_once('./Controller/homeController.php');
        if ($action == 'displayHome'){
            displayHome();
        }elseif($action == 'doSendEmail'){
            doSendEmail();
        }
    }
    if ($controller == 'user'){
        include_once('./Controller/userController.php');
        if ($action == 'displayLogin'){
            displayLogin();
        }elseif($action == 'displayRegister'){
            displayRegister();
        }elseif($action == 'doLogin'){
            doRegister();
        }elseif($action == 'doRegister'){
            doRegister();
        }

    }
}

// Laisse ça commenté en verra tt à la fin car les variables $content ne sont pas
// pour l'instant accessibles ici (pas de return)
// include_once('./View/layout.html.php');
