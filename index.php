<?php
use App\Controller\HomeController;
use App\Controller\PostController;
use App\Controller\UserController;
use App\Controller\CommentController;
use App\Controller\PostAdminController;
use App\Controller\UserAdminController;
use App\Controller\CommentAdminController;
use App\Controller\AdminController;
use App\Controller\BaseController;

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
        $commentController = new commentController($commentManager,$userManager, $postManager);
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

        $entity=null;
        if (isset($_GET['entity'])){
            $entity=$_GET['entity'];
        }

        $adminController=new AdminController();
        $userManager=new UserManager();
        $postManager= new PostManager;
        $commentManager= new CommentManager($postManager, $userManager);
        $postAdminController=New PostAdminController($userManager, $postManager, $commentManager);
        $userAdminController=New UserAdminController($userManager, $postManager, $commentManager);
        $commentAdminController=New commentAdminController($userManager, $postManager, $commentManager);


        $controller=$adminController;




        if ($entity=='post'){
            $controller=$postAdminController;
        }elseif ($entity=='user'){
            $controller=$userAdminController;
        }elseif ($entity=='comment'){
            $controller=$commentAdminController;
        }

        if ($action == 'displayAdminHome'){
            $controller->displayAdminHome();
        }elseif($action == 'displayAdminList'){
            $controller->displayAdminList();
        }elseif($action == 'displayAdminCreate'){
            $controller->displayAdminCreate();
        }elseif($action == 'doAdminCreate'){
            $controller->doAdminCreate();
        }elseif($action == 'displayAdminUpdate'){
            $controller->displayAdminUpdate();
        }elseif($action == 'doAdminUpdate'){
            $controller->doAdminUpdate();
        }elseif($action == 'displayAdminDelete'){
            $controller->displayAdminDelete();
        }elseif($action == 'doAdminDelete'){
            $controller->doAdminDelete();
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
