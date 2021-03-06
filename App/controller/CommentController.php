<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;

class CommentController extends BaseController
{
    private $commentManager;
    private $userManager;

    public function __construct(CommentManager $commentManager, UserManager $userManager, PostManager $postManager)
    {
        $this->commentManager = $commentManager;
        $this->userManager = $userManager;
        $this->postManager = $postManager;
    }

    public function doComment()
    {
        $errors = [];
        $valid = [];

        if (!isset($_SESSION['email'])) {
            $errors[] = 'connexion_required';
            $this->redirect('./index.php?controller=user&action=displayLogin');
        } else {
            $user = $this->userManager->findUserByEmail($_SESSION['email']);
            if (0 == $user->getEnabled()) {
                $errors[] = 'comment.no_authorized';
            }
        }

        if (count($_POST) > 0) {
            $content = $_POST['content'];
            $id_post = $_POST['id_post'];
            $id_user = $user->getId();

            if (empty($content)) {
                $errors[] = 'comment.no_content';
            }

            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                $this->redirect('./index.php?controller=post&action=displayOne&result='.$result.'&id='.$id_post);
            } else {
                $comment = new Comment();
                $comment->setContent($content);
                $comment->setIdPost($id_post);
                $comment->setIdUser($id_user);
                $comment->setCreationDate(date('Y-m-d H:i:s'));

                if($result = $this->commentManager->insert($comment)){
                    $valid[] = 'comment.ok';
                }else{
                    $errors[] = 'comment.ko';
                }

                if (count($valid) > 0) {
                    $_SESSION['valid'] = $valid;
                    $this->redirect('./index.php?controller=post&action=displayOne&result='.$result.'&id='.$id_post);
                }
            }
        }
    }
}
