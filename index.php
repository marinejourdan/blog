<?php
use App\Controller\HomeController;
use App\Controller\PostController;
use App\Controller\UserController;
use App\Controller\CommentController;
use App\Controller\AdminController;

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
        }else{
            die('404 not found');
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
        }else{
            die('404 not found');
        }

        break;

    case'comment':
        $postManager= new PostManager;
        $userManager= new UserManager;
        $commentManager= new CommentManager($postManager, $userManager);
        $commentController = new commentController($postManager,$commentManager,$userManager);
        if ($action == 'doComment'){
            $commentController->doComment();
        }else{
            die('404 not found');
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
        }else{
            die('404 not found');
        }
        break;

    case 'admin':

        $userManager=new UserManager();
        $postManager= new PostManager;
        $commentManager= new CommentManager($postManager, $userManager);
        $adminController=New AdminController($userManager, $postManager, $commentManager);

        if ($action == 'displayAdminHome'){
            $adminController->displayAdminHome();
        }if ($action == 'displayAdminList'){
            $adminController->displayAdminList();
        }if ($action == 'displayAdminCreate'){
            $adminController->displayAdminCreate();
        }if ($action == 'doAdminCreate'){
            $adminController->doAdminCreate();
        }if ($action == 'displayAdminUpdate'){
            $adminController->displayAdminUpdate();
        }if ($action == 'doAdminUpdate'){
            $adminController->doAdminUpdate();
        }if ($action == 'displayAdminDelete'){
            $adminController->displayAdminDelete();
        }if ($action == 'doAdminDelete'){
            $adminController->doAdminDelete();
        }
        break;


    default:
        die('404 not found');



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
