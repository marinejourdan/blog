<?php

// index.php?controller=post&action=displayList
function displayList(){

    // On définit des variable, ici un pauvre titre mais
    // pour displayPost il faudra récupérer l'object post
    $postList=getPostList();
    // On inclut le template qui correspond à la function (equivalent de echo ;)
    // dedans on peut faire des foreach et echo des variable définie au-dessus
    // On récupère tt ce qui est dans la mémoire tampon et on le colle dans une variable
    ob_start();
    include_once ("./View/displayList.html.php");
    $content=ob_get_clean();
    // Tt revient à la normal à partir d'ici
    // On "affiche" la structure html complète qui se charge de faire un echo $content
    // pour placer le contenu au bon endroit dans le html ;)
    include_once("./layout.html.php");
}

// index.php?controller=post&action=displayOne
function displayOne(){
    $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'
    $post=getPost($id_post);
    $commentList= getCommentsFromPost($id_post);
    ob_start();
    include_once ("./View/displayOne.html.php");
    $content=ob_get_clean();
    // Tt revient à la normal à partir d'ici
    // On "affiche" la structure html complète qui se charge de faire un echo $content
    // pour placer le contenu au bon endroit dans le html ;)
    include_once("./layout.html.php");


}

// index.php?controller=post&action=doComment
function doComment(){
    $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'URL
    die('youhou2');
}
