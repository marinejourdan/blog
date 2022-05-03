<?php
use App\Controller\HomeController;
use App\Controller\PostController;
use App\Controller\UserController;
use App\Controller\CommentController;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;

require 'vendor/autoload.php';

session_start();


$controller='home';
if (isset($_GET['controller'])){
    $controller=$_GET['controller'];
}

$action='displayHome';
if (isset($_GET['action'])){
    $action=$_GET['action'];
}

switch($controller){

    case 'home':
        $postManager= new PostManager();
        $homeController = new HomeController($postManager);
        $userManager= new UserManager();
        $commentManager= new CommentManager($postManager, $userManager);

        if ($action == 'displayHome'){
            $homeController->displayHome();
        }elseif ($action == 'doSendEmail'){
            $homeController->doSendEmail();
        }
        break;

    case'post':

        $postManager= new PostManager;
        $userManager= new UserManager();
        $commentManager= new CommentManager($postManager, $userManager);
        $postController = new PostController($postManager, $commentManager);
        if ($action == 'displayList'){
            $postController->displayList();
        }elseif ($action == 'displayOne'){
            $postController->displayOne();
        }

        break;

    case'comment':
        $postManager= new PostManager;
        $userManager= new UserManager;
        $commentManager= new CommentManager;
        $commentController = new commentController($postManager,$commentManager,$userManager);
        if ($action == 'doComment'){
            $commentController->doComment();
        }

        break;


    case 'user':
        $userManager= new UserManager();
        $userController=new UserController($userManager);

        if ($action == 'displayLogin'){
            $userController->displayLogin();
        }elseif ($action == 'displayRegister'){
            $userController->displayRegister();
        }elseif ($action == 'doLogin'){
            $userController->dologin();
        }elseif ($action == 'doRegister'){
            $userController->doRegister();
        }elseif ($action == 'doLogout'){
            $userController->dologout();
        }elseif ($action == 'accessAdmin'){
            $userController->accessAdmin();
        }
        break;
}

// // ROUTER
// if (count($_GET)==0){
//     $homeController->displayHome();
// }else{
//     $controller=$_GET['controller'];
//     $action=$_GET['action'];
//
//     if ($controller == 'post'){
//     $postController=new PostController($postManager,$commentManager);
//         if ($action == 'displayList'){
//             $postController->displayList();
//         }elseif($action == 'displayOne'){
//             $postController->displayOne();
//         }elseif($action == 'doComment'){
//             $postController->doComment();
//         }
//     }
//
//
//
//     if ($controller == 'home'){
//         if ($action == 'displayHome'){
//             $homeController->displayHome();
//         }elseif($action == 'doSendEmail'){
//             $homeController->doSendEmail();
//         }
//     }
//     if ($controller == 'user'){
//     $userController=new UserController();
//         if ($action == 'displayLogin'){
//             $userController->displayLogin();
//         }elseif($action == 'displayRegister'){
//             $userController->displayRegister();
//         }elseif($action == 'doLogin'){
//             $userController->doRegister();
//         }elseif($action == 'doRegister'){
//             $userController->doRegister();
//         }
//
//     }
// }
