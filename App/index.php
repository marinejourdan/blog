<?php

use App\Controller\AdminController;
use App\Controller\BaseController;
use App\Controller\CommentAdminController;
use App\Controller\CommentController;
use App\Controller\HomeController;
use App\Controller\PostAdminController;
use App\Controller\PostController;
use App\Controller\UserAdminController;
use App\Controller\UserController;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;

require 'vendor/autoload.php';

session_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$controller = 'home';
if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}

$action = 'displayHome';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($controller) {
    case 'home':
        $postManager = new PostManager();
        $homeController = new HomeController($postManager);
        $userManager = new UserManager();
        $commentManager = new CommentManager($postManager, $userManager);

        if ('displayHome' == $action) {
            $homeController->displayHome();
        } elseif ('doSendEmail' == $action) {
            $homeController->doSendEmail();
        } else {
            echo '404 not found';
        }
        break;

    case 'post':
        $postManager = new PostManager();
        $userManager = new UserManager();
        $commentManager = new CommentManager($postManager, $userManager);
        $postController = new PostController($postManager, $commentManager);

        if ('displayList' == $action) {
            $postController->displayList();
        } elseif ('displayOne' == $action) {
            $postController->displayOne();
        } else {
            echo '404 not found';
        }
        break;

    case 'comment':
        $postManager = new PostManager();
        $userManager = new UserManager();
        $commentManager = new CommentManager($postManager, $userManager);
        $commentController = new commentController($commentManager, $userManager, $postManager);
        if ('doComment' == $action) {
            $commentController->doComment();
        } else {
            echo '404 not found';
        }
        break;

    case 'user':
        $userManager = new UserManager();
        $userController = new UserController($userManager);

        if ('displayLogin' == $action) {
            $userController->displayLogin();
        } elseif ('displayRegister' == $action) {
            $userController->displayRegister();
        } elseif ('doLogin' == $action) {
            $userController->dologin();
        } elseif ('doRegister' == $action) {
            $userController->doRegister();
        } elseif ('doLogout' == $action) {
            $userController->dologout();
        } else {
            echo '404 not found';
        }
        break;

    case 'admin':
        if (!isset($_SESSION['email'])) {
            BaseController::redirect('./index.php?controller=user&action=displayLogin');
        }

        $entity = null;
        if (isset($_GET['entity'])) {
            $entity = $_GET['entity'];
        }

        $adminController = new AdminController();
        $userManager = new UserManager();
        $postManager = new PostManager();
        $commentManager = new CommentManager($postManager, $userManager);
        $postAdminController = new PostAdminController($userManager, $postManager, $commentManager);
        $userAdminController = new UserAdminController($userManager, $postManager, $commentManager);
        $commentAdminController = new commentAdminController($userManager, $postManager, $commentManager);

        $controller = $adminController;

        if ('post' == $entity) {
            $controller = $postAdminController;
        } elseif ('user' == $entity) {
            $controller = $userAdminController;
        } elseif ('comment' == $entity) {
            $controller = $commentAdminController;
        }

        if ('displayAdminHome' == $action) {
            $controller->displayAdminHome();
        } elseif ('displayAdminList' == $action) {
            $controller->displayAdminList();
        } elseif ('displayAdminCreate' == $action) {
            $controller->displayAdminCreate();
        } elseif ('doAdminCreate' == $action) {
            $controller->doAdminCreate();
        } elseif ('displayAdminUpdate' == $action) {
            $controller->displayAdminUpdate();
        } elseif ('doAdminUpdate' == $action) {
            $controller->doAdminUpdate();
        } elseif ('displayAdminDelete' == $action) {
            $controller->displayAdminDelete();
        } elseif ('doAdminDelete' == $action) {
            $controller->doAdminDelete();
        }

        break;

    default:
        echo '404 not found';
}
