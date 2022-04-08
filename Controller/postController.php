<?php

// index.php?controller=post&action=displayList
function displayList($post){
    ob_start();
    // On définit des variable, ici un pauvre titre mais
    // pour displayPost il faudra récupérer l'object post
    $post=New Post;
    $post->getPostList();

    die('prout');
    // On inclut le template qui correspond à la function (equivalent de echo ;)
    // dedans on peut faire des foreach et echo des variable définie au-dessus
    // On récupère tt ce qui est dans la mémoire tampon et on le colle dans une variable
    include_once ("./View/displayList.html.php.");
    $content=ob_get_clean();
    // Tt revient à la normal à partir d'ici
    // On "affiche" la structure html complète qui se charge de faire un echo $content
    // pour placer le contenu au bon endroit dans le html ;)
    include_once("./layout.html.php");
    var_dump($content);
}
    die('yodghsu');

// index.php?controller=post&action=displayOne
function displayOne(){
    $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'URL
    die('youhou2');
}

// index.php?controller=post&action=doComment
function doComment(){
    $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'URL
    die('youhou2');
}
