<?php
use App\Controller\HomeController;
use App\Controller\PostController;
use App\Controller\UserController;
use App\Manager\CommentManager;
use App\Manager\PostManager;


require 'vendor/autoload.php';

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

        $homeController = new HomeController();

        if ($action == 'displayHome'){
            $homeController->displayHome();
        }elseif ($action == 'doSendEmail'){
            $homeController->doSendEmail();
        }

        break;

    case'post':

        $postManager= new PostManager;
        $commentManager= new CommentManager;
        $postController = new PostController($postManager, $commentManager);

        if ($action == 'displayList'){
            $postController->displayList();
        }elseif ($action == 'displayOne'){
            $postController->displayOne();
        }elseif ($action == 'doComment'){
            $postController->doComment();
        }

        break;

    case 'user':

        $userController=new UserController();

        if ($action == 'displayLogin'){
            $userController->displayLogin();
        }elseif ($action == 'displayRegister'){
            $userController->displayRegister();
        }elseif ($action == 'doLogin'){
            $userController->doRegister();
        }elseif ($action == 'doRegister'){
            $userController->doRegister();
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
