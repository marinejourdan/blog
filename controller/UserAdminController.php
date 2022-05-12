<?php

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Post;
use App\Entity\User;

class UserAdminController extends AdminController
{
    public static $entity = 'User';

    private $userManager;
    private $postManager;
    private $commentManager;

    public function __construct(UserManager $userManager, PostManager $postManager,CommentManager $commentManager ){

       $this->userManager=$userManager;
       $this->postManager=$postManager;
       $this->commentManager=$commentManager;
    }

    function displayAdminList(){
        $userList=$this->userManager->getList();

        $this->renderAdmin(
            "./view/admin/user/userDisplayAdminList.html.php",
            [
                'userList' => $userList,
            ]

        );
    }

    function displayAdminUpdate(){
        $id=$_GET['id'];
        $user=$this->userManager->get($id);

        $this->renderAdmin(
            "./view/admin/user/userdisplayAdminUpdate.html.php",
            [
                'user' => $user,
                'id' => $id,
            ]
        );
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
            $enabled=$_POST['enabled'];

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
                $user->enabled=$enables;
                $result=$this->userManager->update($user);
            }
        }
        $this->redirect('index.php?controller=admin&entity=user&action=displayAdminList');
    }


    function displayAdminCreate(){
        $this->renderAdmin(
            "./view/admin/user/userDisplayAdminCreate.html.php",
            [

            ]
        );
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

                $result=$this->userManager->insert($user);
            }
        }
        $this->redirect('./index.php?controller=admin&entity=user&action=displayAdminList');
    }


    function displayAdminDelete(){

        ob_start();
        $id=$_GET['id'];
        $this->renderAdmin(
            "./view/admin/user/userDisplayAdminDelete.html.php",
            [
                'id' => $id,
            ]
        );

    }


    function doAdminDelete(){
        $id=$_POST['id'];
        $user=$this->userManager->get($id);
        $this->userManager->delete($user);
        $this->redirect('./index.php?controller=admin&entity=user&action=displayAdminList');
    }
}
