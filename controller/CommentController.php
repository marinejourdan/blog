<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Comment;


class CommentController extends BaseController {

private $commentManager;
private $userManager;

    public function __construct(CommentManager $commentManager, UserManager $userManager){
       $this->commentManager=$commentManager;
       $this->userManager=$userManager;
    }

    public function doComment(){


        if (!isset ($_SESSION['email'])){
            $this->redirect('./index.php?controller=user&action=displayLogin');
        }else{
            $user = $this->$userManager->findUserByEmail($_SESSION['email']);
        }

        if(count($_POST)>0){

            $content=$_POST['content'];
            $id_post=$_POST['id_post'];
            $id_user=$user->id_user;

            if (empty($content)){
                echo 'merci de renseigner un contenu';
                die('youhou');
            }else{
                $comment=new Comment;

                $comment->content=$content;
                $comment->id_post=$id_post;
                $comment->id_user=$id_user;
                $comment->creation_date=date('Y-m-d H:i:s');

                $result=$this->commentManager->insertComment($comment);
            }
        }
        $this->redirect('./index.php?controller=post&action=displayOne&result='.$result.'&id='.$id_post);
    }
}
