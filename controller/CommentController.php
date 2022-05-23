<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Comment;


class CommentController extends BaseController {

private $commentManager;
private $userManager;

    public function __construct(CommentManager $commentManager, UserManager $userManager, PostManager $postManager ){
       $this->commentManager=$commentManager;
       $this->userManager=$userManager;
       $this->postManager=$postManager;
    }

    public function doComment(){
        $errors = array();

        if (!isset ($_SESSION['email'])){
            $this->redirect('./index.php?controller=user&action=displayLogin');
        }else{
            $user = $this->userManager->findUserByEmail($_SESSION['email']);
            if ($user->enabled==0){
            $errors[]='comment.no_authorized';

            }
        }

        if(count($_POST)>0){

            $content=$_POST['content'];
            $id_post=$_POST['id_post'];
            $id_user=$user->id;

            if (empty($content)){
                $errors[]='comment.no_content';
            }

            if(count($errors)>0){
                $_SESSION['errors']=$errors;
                $this->redirect('./index.php?controller=post&action=displayOne&result='.$result.'&id='.$id_post);
                exit;

            }else{
                $comment=new Comment;
                $comment->content=$content;
                $comment->id_post=$id_post;
                $comment->id_user=$id_user;
                $comment->creation_date=date('Y-m-d H:i:s');

                $result=$this->commentManager->insert($comment);

            }
                $this->redirect('./index.php?controller=post&action=displayOne&result='.$result.'&id='.$id_post);
        }
    }
}
