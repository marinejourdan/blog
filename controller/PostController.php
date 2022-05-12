<?php

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;

class PostController extends BaseController{

     private $postManager;

     private $commentManager;

    public function __construct(PostManager $postManager, CommentManager $commentManager){
        $this->postManager=$postManager;
        $this->commentManager=$commentManager;
    }

    public function displayList(){

            $postList=$this->postManager->getList();
            $this->render(
            "./view/public/displayList.html.php",
            [
                'postList' => $postList,
            ]
        );

    }


    public function displayOne(){
        $id_post = $_GET['id'];
        $post=$this->postManager->get($id_post);
        $commentList=$this->commentManager->getCommentsFromPost($id_post);
        $this->render(
        "./view/public/displayOne.html.php",
        [
            'post' => $post,
            'commentList' => $commentList,
        ]
    );

    }

    public function doComment(){
        $id_post = $_GET['id'];
        die('youhou2');
    }
}
