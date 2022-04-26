<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;

class PostController{

    // index.php?controller=post&action=displayList
    public function displayList(){

        // On définit des variable, ici un pauvre titre mais
        // pour displayPost il faudra récupérer l'object post
        $postManager= New PostManager;
        $postList=$postManager->getPostList();
        // On inclut le template qui correspond à la function (equivalent de echo ;)
        // dedans on peut faire des foreach et echo des variable définie au-dessus
        // On récupère tt ce qui est dans la mémoire tampon et on le colle dans une variable
        ob_start();
        include_once ("./view/displayList.html.php");
        $content=ob_get_clean();
        // Tt revient à la normal à partir d'ici
        // On "affiche" la structure html complète qui se charge de faire un echo $content
        // pour placer le contenu au bon endroit dans le html ;)
        include_once("./layout.html.php");
    }

    // index.php?controller=post&action=displayOne
    public function displayOne(){
        $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'
        $PostManager= New PostManager;
        $post=$PostManager->getPost($id_post);

        $commentManager= New CommentManager;
        $commentList=$commentManager->getCommentsFromPost($id_post);
        ob_start();
        include_once ("./view/displayOne.html.php");
        $content=ob_get_clean();
        // Tt revient à la normal à partir d'ici
        // On "affiche" la structure html complète qui se charge de faire un echo $content
        // pour placer le contenu au bon endroit dans le html ;)
        include_once("./layout.html.php");


    }

    // index.php?controller=post&action=doComment
    public function doComment(){
        $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'URL
        die('youhou2');
    }
}
