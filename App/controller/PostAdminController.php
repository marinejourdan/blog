<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;

class PostAdminController extends AdminController
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
        $postList = $this->postManager->getList();

        $this->render(
            'post/displayAdminList.html.php',
            [
                'postList' => $postList,
            ]
            );
    }

    public function displayAdminUpdate()
    {
        $id = $_GET['id'];
        $post = $this->postManager->get($id);

        $this->render(
            'post/displayAdminUpdate.html.php',
            [
                'post' => $post,
                'id' => $id,
            ]
        );
    }

    public function doAdminUpdate()
    {
        $errors = [];
        $valid = [];

        if (count($_POST) > 0) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $header = $_POST['header'];
            $content = $_POST['content'];

            if (
                empty($title) ||
                empty($header) ||
                empty($content)
            ) {
                $errors[] = 'post.update.no_content';
            }
            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                $this->redirect('index.php?controller=admin&entity=post&action=displayAdminUpdate');
            } else {
                $post = $this->postManager->get($id);

                $post->setTitle($title);
                $post->setHeader($header);
                $post->setContent($content);
                $post->setUpdated(date('Y-m-d H:i:s'));
                $result = $this->postManager->update($post);

                $valid[] = 'updated.post';

                if (count($valid) > 0) {
                    $_SESSION['valid'] = $valid;
                    $this->redirect('index.php?controller=admin&entity=post&action=displayAdminList');
                }
            }
        }
    }

    public function displayAdminCreate()
    {
        $this->render(
            'post/displayAdminCreate.html.php',
            [
            ]
        );
    }

    public function doAdminCreate()
    {
        $errors = [];
        $valid = [];

        if (count($_POST) > 0) {
            $email = $_SESSION['email'];

            $title = $_POST['title'];
            $header = $_POST['header'];
            $content = $_POST['content'];

            if (
                empty($title) ||
                empty($header) ||
                empty($content)
            ) {
                $errors[] = 'post.create.no_content';
            }
            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                $this->redirect('index.php?controller=admin&entity=post&action=displayAdminCreate');
            } else {
                $post = new Post();
                $post->setTitle($title);
                $post->setHeader($header);
                $post->setContent($content);
                $post->setUpdated(date('Y-m-d H:i:s'));
                $user = $this->userManager->findUserByEmail($email);

                if (!$user instanceof User) {
                    $errors[] = 'create.post.no.user';
                }

                $post->setIdUser($user->getId());
                $result = $this->postManager->insert($post);
                $valid[] = 'create.post';
            }
        }
        if (count($valid) > 0) {
            $_SESSION['valid'] = $valid;
            $this->redirect('./index.php?controller=admin&entity=post&action=displayAdminList');
        }
    }

    public function displayAdminDelete()
    {
        ob_start();
        $id = $_GET['id'];
        $this->render(
            'post/displayAdminDelete.html.php',
            [
                'id' => $id,
            ]
        );
    }

    public function doAdminDelete()
    {
        $valid = [];
        $id = $_POST['id'];
        $post = $this->postManager->get($id);
        $this->postManager->delete($post);
        $valid[] = 'delete.post';

        if (count($valid) > 0) {
            $_SESSION['valid'] = $valid;
            $this->redirect('./index.php?controller=admin&entity=post&action=displayAdminList');
        }
    }
}
