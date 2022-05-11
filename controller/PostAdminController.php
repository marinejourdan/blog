<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Post;
use App\Entity\User;

class PostAdminController extends AdminController
{
    private $userManager;
    private $postManager;
    private $commentManager;

    public function __construct(UserManager $userManager, PostManager $postManager,CommentManager $commentManager ){

       $this->userManager=$userManager;
       $this->postManager=$postManager;
       $this->commentManager=$commentManager;
    }

    function displayAdminHome(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }


    function displayAdminList(){
            $postList=$this->postManager->getList();
            ob_start();
            include_once ("./view/displayAdminList.html.php");
            $content=ob_get_clean();
            include_once ("./layoutAdmin.html.php");
    }


    function displayAdminUpdate(){
        $id=$_GET['id'];
        $post=$this->postManager->get($id);

        ob_start();
        include_once ("./view/displayAdminUpdate.html.php");
        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");

    }


    function doAdminUpdate(){

        if(count($_POST)>0){
            $email=$_SESSION['email'];
            $title=$_POST['title'];
            $header=$_POST['header'];
            $content=$_POST['content'];

            if (
                empty($title) ||
                empty($header)||
                empty($content)
            ){
                echo 'merci de renseigner un contenu';
                die();
            }else{
                $post=new Post;
                $post->title=$title;
                $post->header=$header;
                $post->content=$content;
                $post->updated=date('Y-m-d H:i:s');
                $user=$this->userManager->findUserByEmail($email);

                if (!$user instanceof User){
                    die('nous n avons pas trouvé le user');
                }

                $post->id_user=$user->id;
                $result=$this->postManager->update($post);
            }

        }
        $this->redirect('index.php?controller=admin&entity=post&action=displayAdminList');
    }


    function displayAdminCreate(){
        ob_start();
        include_once("./view/displayAdminCreate.html.php");

        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }


    function doAdminCreate(){


        if(count($_POST)>0){
            $email=$_SESSION['email'];


            $title=$_POST['title'];
            $header=$_POST['header'];
            $content=$_POST['content'];


            if (
                empty($title) ||
                empty($header)||
                empty($content)
            ){
                echo 'merci de renseigner un contenu';
                die();
            }else{


                $post=new Post;
                $post->title=$title;
                $post->header=$header;
                $post->content=$content;
                $post->updated=date('Y-m-d H:i:s');
                $user=$this->userManager->findUserByEmail($email);

                if (!$user instanceof User){
                    die('nous n avons pas trouvé le user');
                }

                $post->id_user=$user->id;
                $result=$this->postManager->insert($post);
            }

        }
        $this->redirect('./index.php?controller=admin&entity=post&action=displayAdminList');
    }

    function displayAdminDelete(){

        ob_start();
        $id=$_GET['id'];
        include_once("./view/displayAdminDelete.html.php");
        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }

    function doAdminDelete(){
        $id=$_POST['id'];
        $post=$this->postManager->get($id);
        $this->postManager->delete($post);
        $this->redirect('./index.php?controller=admin&entity=post&action=displayAdminList');
    }
}
