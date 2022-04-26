<?php
use App\Controller\HomeController;
use App\Controller\PostController;
use App\Controller\UserController;
require 'vendor/autoload.php';


//var_dump($_GET);

// ROUTER
if (count($_GET)==0){
    HomeController::displayHome();
}else{
    $controller=$_GET['controller'];
    $action=$_GET['action'];

    if ($controller == 'post'){
        if ($action == 'displayList'){
            PostController::displayList();
        }elseif($action == 'displayOne'){
            PostController::displayOne();
        }elseif($action == 'doComment'){
            PostController::doComment();
        }
    }
    if ($controller == 'home'){
        if ($action == 'displayHome'){
            HomeController::displayHome();
        }elseif($action == 'doSendEmail'){
            HomeController::doSendEmail();
        }
    }
    if ($controller == 'user'){
        include_once('./controller/userController.php');
        if ($action == 'displayLogin'){
            UserController::displayLogin();
        }elseif($action == 'displayRegister'){
            UserController::displayRegister();
        }elseif($action == 'doLogin'){
            UserController::doRegister();
        }elseif($action == 'doRegister'){
            UserController::doRegister();
        }

    }
}

// Laisse ça commenté en verra tt à la fin car les variables $content ne sont pas
// pour l'instant accessibles ici (pas de return)
// include_once('./view/layout.html.php');
