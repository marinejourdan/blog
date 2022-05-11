<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;

class CommentAdminController extends AdminController
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
            $commentList=$this->commentManager->getList();
            ob_start();
            include_once ("./view/commentDisplayAdminList.html.php");
            $content=ob_get_clean();
            include_once ("./layoutAdmin.html.php");
    }


    function displayAdminUpdate(){
        $id=$_GET['id'];
        $comment=$this->commentManager->get($id);

        ob_start();
        include_once ("./view/commentDisplayAdminUpdate.html.php");
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
        $this->redirect('index.php?controller=admin&entity=comment&action=commentDisplayAdminList');
    }


    function displayAdminCreate(){
        ob_start();
        include_once("./view/CommentDisplayAdminCreate.html.php");

        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }

    function displayAdminDelete(){

        ob_start();
        $id=$_GET['id'];
        include_once("./view/commentDisplayAdminDelete.html.php");
        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }

    function doAdminDelete(){
        $id=$_POST['id'];
        $comment=$this->commentManager->get($id);
        $this->commentManager->delete($comment);
        $this->redirect('./index.php?controller=admin&entity=comment&action=displayAdminList');
    }
}
