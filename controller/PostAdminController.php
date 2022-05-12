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


            $this->renderAdmin(
            "./view/displayAdminList.html.php",
            [
                'postList' => $postList,
            ]
            );

        }



    function displayAdminUpdate(){
        $id=$_GET['id'];
        $post=$this->postManager->get($id);

        $this->renderAdmin(
            "./view/displayAdminUpdate.html.php",
            [
                'post' => $post,
                'id' => $id,
            ]
        );
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

        $this->renderAdmin(
            "./view/displayAdminCreate.html.php",
            [

            ]
        );
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
        $this->renderAdmin(
            "./view/displayAdminDelete.html.php",
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
