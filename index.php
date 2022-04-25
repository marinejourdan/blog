<?php
require 'vendor/autoload.php';
include_once('./manager/manager.php');

//var_dump($_GET);

// ROUTER
if (count($_GET)==0){
    include_once('./controller/homeController.php');
    displayHome();
}else{
    $controller=$_GET['controller'];
    $action=$_GET['action'];

    if ($controller == 'post'){
        include_once('./controller/postController.php');
        if ($action == 'displayList'){
            displayList();
        }elseif($action == 'displayOne'){
            displayOne();
        }elseif($action == 'doComment'){
            doComment();
        }
    }
    if ($controller == 'home'){
        include_once('./controller/homeController.php');
        if ($action == 'displayHome'){
            displayHome();
        }elseif($action == 'doSendEmail'){
            doSendEmail();
        }
    }
    if ($controller == 'user'){
        include_once('./controller/userController.php');
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
// include_once('./view/layout.html.php');
