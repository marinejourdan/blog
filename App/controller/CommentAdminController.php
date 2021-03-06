<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;

class CommentAdminController extends AdminController
{
    private $userManager;
    private $postManager;
    private $commentManager;

    public function __construct(UserManager $userManager, PostManager $postManager, CommentManager $commentManager)
    {
        $this->userManager = $userManager;
        $this->postManager = $postManager;
        $this->commentManager = $commentManager;
    }

    public function displayAdminList()
    {
        $commentList = $this->commentManager->getList();
        $this->render(
            'comment/commentDisplayAdminList.html.php',
            [
                'commentList' => $commentList,
            ]
            );
    }

    public function displayAdminUpdate()
    {
        $id = $_GET['id'];
        if (!isset($_GET['id'])) {
            $this->redirect('./index.php?controller=user&action=displayAdminHome');
        }
        $comment = $this->commentManager->get($id);
        $this->render(
            'comment/commentDisplayAdminUpdate.html.php',
            [
                'comment' => $comment,
                'id' => $id,
            ]
        );
    }

    public function doAdminUpdate()
    {
        $valid = [];

        if (count($_POST) > 0) {
            $email = $_SESSION['email'];
            $publication = $_POST['publication'];
            $id = $_POST['id'];

            $comment = new Comment();
            $comment->setPublication($publication);
            $comment->setId($id);

            $result = $this->commentManager->publishComment($comment);
            $valid[] = 'updated.comment';

            if (count($valid) > 0) {
                $_SESSION['valid'] = $valid;
                $this->redirect('index.php?controller=admin&entity=comment&action=displayAdminList');
            }
        }
    }

    public function displayAdminCreate()
    {
        $this->renderAdmin(
            'comment/commentDisplayAdminCreate.html.php',
            [
            ]
        );
    }

    public function displayAdminDelete()
    {
        $id = $_GET['id'];
        $this->renderAdmin(
            'comment/commentDisplayAdminDelete.html.php',
            [
                'id' => $id,
            ]
        );
    }

    public function doAdminDelete()
    {
        $valid = [];
        $id = $_POST['id'];
        $comment = $this->commentManager->get($id);
        $this->commentManager->delete($comment);
        $valid[] = 'delete.comment';

        if (count($valid) > 0) {
            $_SESSION['valid'] = $valid;
            $this->redirect('./index.php?controller=admin&entity=comment&action=displayAdminList');
        }
    }
}
