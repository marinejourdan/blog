<?php

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Post;
use App\Entity\User;

class UserAdminController extends AdminController
{
    private $userManager;
    private $postManager;
    private $commentManager;

    public function __construct(UserManager $userManager, PostManager $postManager,CommentManager $commentManager ){

       $this->userManager=$userManager;
       $this->postManager=$postManager;
       $this->commentManager=$commentManager;
    }

    function displayAdminList(){
            $userList=$this->userManager->getUserList();
            include_once ("./view/userDisplayAdminList.html.php");
            $content=ob_get_clean();
            include_once ("./layoutAdmin.html.php");
    }

    function displayAdminUpdate(){
        $id=$_GET['id'];
        $user=$this->userManager->getUser($id);

        ob_start();
        include_once ("./view/userDisplayAdminUpdate.html.php");
        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }

    function doAdminUpdate(){

        if(count($_POST)>0){
            $email=$_SESSION['email'];
            $name=$_POST['name'];
            $first_name=$_POST['first_name'];
            $id=$_POST['id'];
            $nickname=$_POST['nickname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $access=$_POST['access'];

            if (
                empty($name) ||
                empty($first_name)||
                empty($nickname)||
                empty($email)||
                empty($password)
            ){
                echo 'merci de renseigner un contenu';
                die();

            }else{
                $user=new User;
                $user->id=$id;
                $user->name=$name;
                $user->first_name=$first_name;
                $user->nickname=$nickname;
                $user->email=$email;
                $user->password=$password;
                $user->access=$access;
                $result=$this->userManager->updateUser($user);
            }
        }
        $this->redirect('index.php?controller=admin&entity=user&action=displayAdminList');
    }


    function displayAdminCreate(){
        ob_start();
        include_once("./view/userDisplayAdminCreate.html.php");

        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }


    function doAdminCreate(){

        if(count($_POST)>0){
            $email=$_SESSION['email'];
            $name=$_POST['name'];
            $first_name=$_POST['first_name'];
            $nickname=$_POST['nickname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $access=$_POST['access'];

            if (
                empty($name) ||
                empty($first_name)||
                empty($nickname)||
                empty($email)||
                empty($password)
            ){
                echo 'merci de renseigner un contenu';
                die();
            }else{

                $user=new User;
                $user->name=$name;
                $user->first_name=$first_name;
                $user->nickname=$nickname;
                $user->email=$email;
                $user->password=$password;
                $user->access=$access;

                $result=$this->userManager->insertUser($user);
            }
        }
        $this->redirect('./index.php?controller=admin&entity=user&action=displayAdminList');
    }


    function displayAdminDelete(){

        ob_start();
        $id=$_GET['id'];
        include_once("./view/userDisplayAdminDelete.html.php");
        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }



    function doAdminDelete(){
        $id=$_POST['id'];
        $user=$this->userManager->getUser($id);
        $this->userManager->deletUser($user);
        $this->redirect('./index.php?controller=admin&entity=user&action=displayAdminList');
    }
}
