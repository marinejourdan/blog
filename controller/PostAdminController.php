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

    function displayAdminList(){
        $postList=$this->postManager->getList();

            $this->render(
            "post/displayAdminList.html.php",
            [
                'postList' => $postList,
            ]
            );

        }

    function displayAdminUpdate(){
        $id=$_GET['id'];
        $post=$this->postManager->get($id);

        $this->render(
            "post/displayAdminUpdate.html.php",
            [
                'post' => $post,
                'id' => $id,
            ]
        );
    }

    function doAdminUpdate(){
        $errors[]=array();

        if(count($_POST)>0){
            $id=$_POST['id'];
            $title=$_POST['title'];
            $header=$_POST['header'];
            $content=$_POST['content'];

            if (
                empty($title) ||
                empty($header)||
                empty($content)
            ){
                $errors[]= 'no_content';

            }if(count($errors)>0){
                $_SESSION['errors']=$errors;
                $this->redirect('index.php?controller=admin&entity=post&action=displayAdminUpdate');

            }else{
                $post=$this->postManager->get($id);
                $post->title=$title;
                $post->header=$header;
                $post->content=$content;
                $post->updated=date('Y-m-d H:i:s');
                $result=$this->postManager->update($post);
            }
        }
        $this->redirect('index.php?controller=admin&entity=post&action=displayAdminList');
    }

    function displayAdminCreate(){

        $this->render(
            "post/displayAdminCreate.html.php",
            [

            ]
        );
    }

    function doAdminCreate(){
        $errors[]=array();

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
                $errors[]='no_content';

            }if(count($errors)>0){
                $_SESSION['errors']=$errors;
                $this->redirect('index.php?controller=admin&entity=post&action=displayAdminCreate');

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
        $this->render(
            "post/displayAdminDelete.html.php",
            [
                'id' => $id,
            ]
        );
    }

    function doAdminDelete(){
        $id=$_POST['id'];
        $post=$this->postManager->get($id);
        $this->postManager->delete($post);
        $this->redirect('./index.php?controller=admin&entity=post&action=displayAdminList');
    }
}
