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
        ob_start();
        include_once ("./view/displayList.html.php");
        $content=ob_get_clean();
        include_once("./layout.html.php");
    }

    public function displayOne(){
        $id_post = $_GET['id'];
        $post=$this->postManager->get($id_post);
        $commentList=$this->commentManager->getCommentsFromPost($id_post);
        ob_start();
        include_once ("./view/displayOne.html.php");
        $content=ob_get_clean();
        include_once("./layout.html.php");
    }

    public function doComment(){
        $id_post = $_GET['id'];
        die('youhou2');
    }
}
