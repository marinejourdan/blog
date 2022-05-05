<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Post;
use App\Entity\User;

class AdminController
{
    private $userManager;
    private $postManager;
    private $commentManager;

    public function __construct(UserManager $userManager, PostManager $postManager,CommentManager $commentManager ){

       $this->userManager=$userManager;
       $this->postManager=$postManager;
       $this->commentManager=$commentManager;
    }

    function displayAdminHome(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }


    function displayAdminList(){
        // On définit des variable, ici un pauvre titre mais
        // pour displayPost il faudra récupérer l'object post

            $postList=$this->postManager->getPostList();

            // On inclut le template qui correspond à la function (equivalent de echo ;)
            // dedans on peut faire des foreach et echo des variable définie au-dessus
            // On récupère tt ce qui est dans la mémoire tampon et on le colle dans une variable
            ob_start();
            include_once ("./view/displayAdminList.html.php");
            $content=ob_get_clean();
            // Tt revient à la normal à partir d'ici
            // On "affiche" la structure html complète qui se charge de faire un echo $content
            // pour placer le contenu au bon endroit dans le html ;)
            include_once ("./layoutAdmin.html.php");
    }


    function displayAdminCreate(){
        ob_start();
        include_once("./view/displayAdminCreate.html.php");

        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }


    function displayAdminUpdate(){
        $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'
        $post=$this->postManager->getPost($id_post);

        ob_start();
        include_once ("./view/displayAdminUpdate.html.php");
        $content=ob_get_clean();
        // Tt revient à la normal à partir d'ici
        // On "affiche" la structure html complète qui se charge de faire un echo $content
        // pour placer le contenu au bon endroit dans le html ;)
        include_once("./layoutAdmin.html.php");

    }

    function doAdminCreate(){


        if(count($_POST)>0){

            $title=$_POST['title'];
            $header=$_POST['header'];
            $content=$_POST['content'];
            $email=$_SESSION['email'];

            if (empty($content)){
                echo 'merci de renseigner un contenu';
                die('youhou');
            }else{

                $post=new Post;
                $post->title=$title;
                $post->header=$header;
                $post->content=$content;
                $post->updated=date('Y-m-d H:i:s');
                $post->id_user=1;
                $result=$this->postManager->insertPost($post);
            }
        }
        header('Location:./index.php?controller=admin&action=displayAdminList');
        exit();
    }


    function doAdminUpdate(){
        $post=New Post;
        $_POST['id']=$post->id;
        $this->postManager->updatePost($post);
        header('location: index.php?controller=admin&action=displayAdminHome');
        exit();
    }
    function displayAdminDelete(){
        
        ob_start();

        include_once("./view/displayAdminDelete.html.php");


        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }



    function doAdminDelete(){
        $id=$_POST['id'];
        $post=New Post;
        $id=$post->id;
        $this->postManager->deletPost($post);
        header('location: index.php?controller=admin&action=displayAdminList');
        exit();

    }
}
