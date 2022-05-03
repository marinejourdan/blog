<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Comment;


class CommentController{

private $commentManager;

    public function __construct(CommentManager $commentManager){
       $this->commentManager=$commentManager;
    }

    public function doComment(){


        if (!isset ($_SESSION['email'])){
            header('location: index.php?controller=user&action=displayLogin');
        }else{
            $userManager= new UserManager;
            $user = $userManager->findUserByEmail($_SESSION['email']);
        }

        if(count($_POST)>0){

            $content=$_POST['content'];
            $id_post=$_POST['id_post'];
            $id_user=$user->id;

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
        header('Location:./index.php?controller=post&action=displayOne&result='.$result.'&id='.$_POST['id_post']);
        exit();
    }
}
